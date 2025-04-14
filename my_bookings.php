<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "tennis_db";
$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Ühenduse viga: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM bookings WHERE user_id = ? ORDER BY date, time";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Minu broneeringud</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="booking-page">

<div class="booking-container">

<h1 class="my-bookings-title center-text">Minu broneeringud</h1>

<div class="center-text">
    <a href="booking.php" class="booking-button">Broneeri uus trenn</a>
</div>



<?php if ($result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Kuupäev</th>
            <th>Kellaaeg</th>
            <th>Treener</th>
            <th>Nimi</th>
            <th>E-mail</th>
            <th>Tegevus</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= date('d.m.Y', strtotime($row['date'])) ?></td>
                <td><?= htmlspecialchars($row['time']) ?></td>
                <td><?= htmlspecialchars($row['trainer']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                     <a href="my_edit_booking.php?id=<?= $row['id'] ?>" class="edit-link">Muuda</a>
                    <a href="delete_booking.php?id=<?= $row['id'] ?>" class="delete-link" onclick="return confirm('Kas oled kindel, et soovid kustutada?');">Kustuta</a>
                </td> 
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Sul pole veel ühtegi broneeringut.</p>
<?php endif; ?>

</div>

</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>

<?php $conn->close(); ?>
