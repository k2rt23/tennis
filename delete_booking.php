<?php
session_start();
require_once 'db/config.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];  

    $sql = "DELETE FROM bookings WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        header("Location: my_bookings.php");
        exit();
    } else {
        echo "Viga kustutamisel: " . $conn->error;
    }
}

$conn->close();
?>
