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
        header("Location: my_bookings.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muuda oma broneeringut</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?> 

<main class="booking-page">

<div class="booking-container">

<h1>Muuda oma broneeringut</h1>

<form method="POST">

    <label>Kuupäev:</label>
    <input class="form-input" type="date" name="date" value="<?= htmlspecialchars($booking['date']) ?>" required>

    <label>Kellaaeg:</label>
    <select class="form-input" name="time" required>
        <option value="17:00" <?= ($booking['time'] == '17:00') ? 'selected' : '' ?>>17:00</option>
        <option value="18:00" <?= ($booking['time'] == '18:00') ? 'selected' : '' ?>>18:00</option>
        <option value="19:00" <?= ($booking['time'] == '19:00') ? 'selected' : '' ?>>19:00</option>
        <option value="20:00" <?= ($booking['time'] == '20:00') ? 'selected' : '' ?>>20:00</option>
    </select>

    <label>Treener:</label>
    <select class="form-input" name="trainer" required>
        <option value="Kärt-Triin Laagus" <?= ($booking['trainer'] == 'Kärt-Triin Laagus') ? 'selected' : '' ?>>Kärt-Triin Laagus</option>
    </select>

    <label>Nimi:</label>
    <input class="form-input" type="text" name="name" value="<?= htmlspecialchars($booking['name']) ?>" required>

    <label>E-mail:</label>
    <input class="form-input" type="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required>

    <button class="form-button" type="submit">Salvesta muudatused</button>

</form>


</div> 
</main>

<?php include 'includes/footer.php'; ?>