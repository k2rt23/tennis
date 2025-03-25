<?php
session_start(); 
require_once 'db/config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $row['role'];

            echo "<script>alert('Sisselogimine õnnestus!'); window.location.href='admin_bookings.php';</script>";
            exit();
        } else {
            $error = "Vale parool!";
        }
    } else {
        $error = "Kasutajat ei leitud!";
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logi sisse</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Sisselogimine</h1>

    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Parool" required>
        <button type="submit">Logi sisse</button>
    </form>
    <p>Pole veel kasutajat? <a href="register.php">Registreeru siit</a></p>

</body>
</html>
