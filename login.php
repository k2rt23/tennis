<?php
require_once 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Sisselogimine õnnestus!";
        } else {
            echo "Vale parool!";
        }
    } else {
        echo "Kasutajat ei leitud!";
    }
}
?>

<form method="POST" action="login.php">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="password" placeholder="Parool" required>
    <button type="submit">Logi sisse</button>
</form>
