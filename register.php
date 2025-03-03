<?php
require_once 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registreerimine õnnestus!";
    } else {
        echo "Viga: " . $sql . "<br>" . $conn->error;
    }
}
?>

<form method="POST" action="register.php">
    <input type="text" name="name" placeholder="Nimi" required>
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Parool" required>
    <button type="submit">Registreeri</button>
</form>
