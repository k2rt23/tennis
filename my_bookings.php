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
    <style>
        body { font-family: Arial; margin: 20px; background-color: #f8f9fa; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #007bff; color: white; }
        h1 { margin-bottom: 20px; }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <h1>Minu broneeringud</h1>

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
                        <td><?= htmlspecialchars($row['date']) ?></td>
                        <td><?= htmlspecialchars($row['time']) ?></td>
                        <td><?= htmlspecialchars($row['trainer']) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td>
    <a href="my_edit_booking.php?id=<?= $row['id'] ?>">Muuda</a>
    <a href="delete_booking.php?id=<?= $row['id'] ?>" onclick="return confirm('Kas oled kindel, et soovid kustutada?');">Kustuta</a>
</td>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Sul pole veel ühtegi broneeringut.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p style="text-align:center;">&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
