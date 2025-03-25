<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'db/config.php';

$bookingId = $_GET['id'];
$userId = $_SESSION['user_id'];


$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $bookingId, $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Broneeringut ei leitud või sul pole sellele ligipääsu.";
    exit();
}

$booking = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $trainer = $_POST['trainer'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update = $conn->prepare("UPDATE bookings SET date=?, time=?, trainer=?, name=?, email=? WHERE id=? AND user_id=?");
    $update->bind_param("ssssssi", $date, $time, $trainer, $name, $email, $bookingId, $userId);

    if ($update->execute()) {
        echo "<script>alert('Broneering uuendatud!'); window.location.href='my_bookings.php';</script>";
        exit();
    } else {
        echo "Viga salvestamisel: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Muuda oma broneeringut</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Muuda oma broneeringut</h1>
    <form method="POST">
        <label>Kuupäev:</label>
        <input type="date" name="date" value="<?= $booking['date'] ?>" required><br>

        <label>Kellaaeg:</label>
        <input type="time" name="time" value="<?= $booking['time'] ?>" required><br>

        <label>Treener:</label>
        <select name="trainer" required>
            <option value="trainer1" <?= ($booking['trainer'] == 'trainer1') ? 'selected' : '' ?>>Treener 1</option>
            <option value="trainer2" <?= ($booking['trainer'] == 'trainer2') ? 'selected' : '' ?>>Treener 2</option>
        </select><br>

        <label>Nimi:</label>
        <input type="text" name="name" value="<?= $booking['name'] ?>" required><br>

        <label>E-mail:</label>
        <input type="email" name="email" value="<?= $booking['email'] ?>" required><br>

        <button type="submit">Salvesta muudatused</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
