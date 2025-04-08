<?php
require_once 'db/config.php';

$token = $_GET['token'] ?? '';

if (!$token) {
    die("Puudub token.");
}

$sql = "SELECT * FROM password_resets WHERE token = ? AND expires_at > NOW()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Token on kehtetu või aegunud.");
}

$row = $result->fetch_assoc();
$email = $row['email'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (strlen($new_password) < 6) {
        $error = "Parool peab olema vähemalt 6 tähemärki.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Paroolid ei kattu.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $update->bind_param("ss", $hashed_password, $email);
        $update->execute();

        
        $delete = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
        $delete->bind_param("s", $token);
        $delete->execute();

        echo "<script>alert('Parool on uuendatud!'); window.location.href='login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Taasta parool</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Uus parool</h1>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="password" name="password" placeholder="Uus parool" required><br>
        <input type="password" name="confirm_password" placeholder="Korda parooli" required><br>
        <button type="submit">Uuenda parool</button>
    </form>
</body>
</html>
