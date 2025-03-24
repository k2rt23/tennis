<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $trainer = $_POST['trainer'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "tennis_db";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Ühenduse viga: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bookings (date, time, trainer, name, email) VALUES ('$date', '$time', '$trainer', '$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        //mail($email, "Broneering kinnitatud", "Tere $name,\n\nTeie broneering on kinnitatud. Siin on teie detailid:\n\nKuupäev: $date\nKellaaeg: $time\nTreener: $trainer\n\nParimate soovidega,\nTennisetreeningud");

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
        <a href="trainings.php">Minust</a>
        <a href="contact.php">Treeningud</a>
        <a href="contact.php">Hinnakiri</a>
        <a href="contact.php">Kontakt</a>


    </nav>
</header>

<main>
    <h1>Broneeri treening</h1>
    <p>Vali kuupäev, kellaaeg ja treener ning täida oma andmed.</p>

    <form action="booking.php" method="post">
        <label for="date">Vali kuupäev:</label><br>
        <input type="date" id="date" name="date" required><br><br>

        <label for="time">Vali kellaaeg:</label><br>
        <input type="time" id="time" name="time" required><br><br>

        <label for="trainer">Treener:</label><br>
        <select id="trainer" name="trainer" required>
            <option value="trainer1">Treener 1</option>
            <option value="trainer2">Treener 2</option>
        </select><br><br>

        <label for="name">Nimi:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Broneeri">
    </form>
</main>

<footer>
    <p>&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
</footer>

</body>
</html>