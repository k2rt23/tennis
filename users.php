<?php
require_once 'db/config.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nimi: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "Kasutajaid ei leitud.";
}
?>
