<?php
require_once 'db/config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kontrollime, kas paroolid on samad
    if ($password !== $confirm_password) {
        $error = "Paroolid ei kattu!";
    } else {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password_hashed);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Viga registreerimisel: " . $conn->error;
        }

        $stmt->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Registreeru</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="register-container">

    <h1>Registreeru</h1>

    <?php if (!empty($error)): ?>
        <p class="error-message"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">

        <label>Nimi:</label>
        <input type="text" name="name" required>

        <label>E-mail:</label>
        <input type="email" name="email" required>

        <label>Parool:</label>
        <input type="password" name="password" required>

        <label>Korda parooli:</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Registreeru</button>

    </form>

    <p class="register-link">On juba kasutaja? <a href="login.php">Logi sisse siit</a></p>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
