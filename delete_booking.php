<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tennis_db";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse viga: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Broneering kustutatud!'); window.location.href='admin_bookings.php';</script>";
    } else {
        echo "Viga kustutamisel: " . $conn->error;
    }
}

$conn->close();
?>
