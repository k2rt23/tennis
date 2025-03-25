<?php
require_once 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error = "Paroolid ei kattu!";
    } else {
    
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Selle e-mailiga konto on juba olemas!";
        } else {
           
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $hashed_password);
            
            if ($stmt->execute()) {
                echo "<script>alert('Registreerimine õnnestus! Nüüd saad sisse logida.'); window.location.href='login.php';</script>";
                exit();
            } else {
                $error = "Viga registreerimisel: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreeru</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Registreeru</h1>

    <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>

    <form method="POST" action="register.php">
        <input type="email" name="email" placeholder="E-mail" required><br>
        <input type="password" name="password" placeholder="Parool" required><br>
        <input type="password" name="confirm_password" placeholder="Korda parooli" required><br>
        <button type="submit">Registreeru</button>
    </form>

    <p>Juba konto olemas? <a href="login.php">Logi sisse</a></p>
</body>
</html>
