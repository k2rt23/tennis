<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tennis_db";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse viga: " . $conn->connect_error);
} else {
    echo "Andmebaasi ühendus õnnestus!";
}
?>
