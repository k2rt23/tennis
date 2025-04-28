<?php
session_start();
require_once 'db/config.php'; 

if (!isset($_SESSION['user_id'])) {
    die("Sa pead olema sisse logitud, et broneerida.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $trainer = $_POST['trainer'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userId = $_SESSION['user_id'];

    if (empty($date) || empty($time) || empty($trainer) || empty($name) || empty($email) || empty($userId)) {
        die("Kõik väljad peavad olema täidetud!");
    }

    $sql = "INSERT INTO bookings (date, time, trainer, name, email, user_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("SQL päringu ettevalmistamine ebaõnnestus: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $date, $time, $trainer, $name, $email, $userId);

    if ($stmt->execute()) {
        echo "Teie broneering on edukalt tehtud. Kinnitus on saadetud teie e-posti aadressile.";
    } else {
        echo "Viga broneeringu salvestamisel: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broneeri treening</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <nav>
        <a href="index.php">Avaleht</a>
        <a href="contact.php">Treeningud ja hinnad</a>
        <a href="contact.php">Kontakt</a>
        <a href="contact.php">Logi sisse</a>
        <a href="contact.php">Registreeru</a>
    </nav>
</header>

<main>
<div class="booking-container">
    <h1>Broneeri treening</h1>
    <p>Vali sobiv kuupäev ja kellaaeg ning täida oma andmed.</p>

    <form method="POST" action="booking.php">

        <label>Vali kuupäev:</label>
        <input type="date" name="date" id="datePicker" required>

        <label>Vali kellaaeg:</label>
        <select name="time" required>
            <option value="">-- Vali kellaaeg --</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
        </select>

        <label>Treener:</label>
        <select name="trainer" required>
            <option value="Kärt-Triin Laagus">Kärt-Triin Laagus</option>
        </select>

        <label>Nimi:</label>
        <input type="text" name="name" required>

        <label>E-mail:</label>
        <input type="email" name="email" required>

        <button type="submit">Broneeri</button>
    </form>
</div>
</main>

<script>
    document.getElementById('datePicker').addEventListener('input', function() {
        const date = new Date(this.value);
        const day = date.getDay(); 

        if (day === 0 || day === 6) {
            alert('Vali kuupäev esmaspäevast reedeni!');
            this.value = '';
        }
    });
</script>
