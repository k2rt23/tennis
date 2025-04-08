<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $weekday = $_POST['weekday'];
    $time = $_POST['time'];
    $trainer = $_POST['trainer'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userId = $_SESSION['user_id'];

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "tennis_db";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Ühenduse viga: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bookings (weekday, time, trainer, name, email, user_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $weekday, $time, $trainer, $name, $email, $userId);

    if ($stmt->execute()) {
        echo "Teie broneering on edukalt tehtud. Kinnitus on saadetud teie e-posti aadressile.";
    } else {
        echo "Viga broneeringu salvestamisel: " . $conn->error;
    }

    $conn->close();
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
    <label>Vali nädalapäev:</label>
    <select name="weekday" required>
        <option value="">-- Vali päev --</option>
        <option value="Esmaspäev">Esmaspäev</option>
        <option value="Teisipäev">Teisipäev</option>
        <option value="Kolmapäev">Kolmapäev</option>
        <option value="Neljapäev">Neljapäev</option>
        <option value="Reede">Reede</option>
    </select>

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
        <option value="Treener 1">Kärt-Triin Laagus</option>
    </select>

    <label>Nimi:</label>
    <input type="text" name="name" required>

    <label>E-mail:</label>
    <input type="email" name="email" required>

    <button type="submit">Broneeri</button>
</form>

</main>

<footer>
    <p>&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
</footer>

</body>
</html>