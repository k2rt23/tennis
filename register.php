<?php
require_once 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $weekday = $_POST['weekday']; 
    $time = $_POST['time'];
    $trainer = $_POST['trainer'];
    $email = trim($_POST['name']);
    $password = trim($_POST['email']);

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "tennis_db";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Ühenduse viga: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bookings (weekday, time, trainer, name, email) 
    VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $weekday, $time, $trainer, $name, $email);

if ($stmt->execute()) {
echo "<p>Teie broneering on edukalt tehtud. Kinnitus on saadetud teie e-posti aadressile.</p>";
} else {
echo "Viga broneeringu salvestamisel: " . $conn->error;
}

$stmt->close();
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
<style>
body {
    background-color: #fdf9f3;
    font-family: 'Segoe UI', sans-serif;
    margin: 0;
}

header nav {
    background-color: #eee8dc;
    padding: 10px;
    text-align: center;
}

header nav a {
    background-color: #d1b28e;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    margin: 5px;
    border-radius: 5px;
}

.booking-container {
    max-width: 500px;
    background: white;
    padding: 30px;
    margin: 50px auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    color: #3a2e2e;
}

label {
    display: block;
    margin-top: 15px;
    font-weight: bold;
}

select, input[type="text"], input[type="email"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
    background-color: #eef4ff;
}

button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background-color: #d1b28e;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
}

footer {
    text-align: center;
    margin-top: 50px;
    padding: 20px;
    background-color: #333;
    color: white;
}
</style>
</head>
<body>

<header>
<nav>
<a href="index.php">Avaleht</a>
<a href="trainings.php">Treeningud ja hinnad</a>
<a href="contact.php">Kontakt</a>
<a href="login.php">Logi sisse</a>
<a href="register.php">Registreeru</a>
</nav>
</header>

<main>
<div class="booking-container">
<h1>Broneeri treening</h1>
<p>Vali sobiv nädalapäev ja kellaaeg ning täida oma andmed.</p>

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

<footer>
<p>&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
</footer>

</body>
</html>