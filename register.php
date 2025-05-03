<?php
require_once 'db/config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Paroolid ei kattu!";
    } else {
        $check_sql = "SELECT id FROM users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $error = "Selle e-mailiga kasutaja on juba olemas!";
        } else {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $password_hashed, $role);

            if ($stmt->execute()) {
                $to = $email;
                $subject = "Tere tulemast tenniseklubisse!";
                $message = "Tere $name!\n\nOlete edukalt registreerunud meie tenniseklubisse.";
                $headers = "From: kontakt@latennis.ee";

                mail($to, $subject, $message, $headers);

                header("Location: login.php");
                exit();
            } else {
                $error = "Midagi läks valesti. Palun proovi uuesti.";
            }

            $stmt->close();
        }
        $check_stmt->close();
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

    <form method="POST" action="register.php">
    <label>Nimi:</label>
    <input type="text" name="name" required>

    <label>E-mail:</label>
    <input type="email" name="email" required>

    <label>Parool:</label>
    <input type="password" name="password" required minlength="6">

    <label>Korda parooli:</label>
    <input type="password" name="confirm_password" required minlength="6">

    <label>Roll:</label>
    <select name="role" required>
        <option value="client">Klient</option>
        <option value="trainer">Treener</option>
    </select>

    <button type="submit">Registreeru</button>
    </form>

    <p class="register-link">On juba kasutaja? <a href="login.php">Logi sisse siit</a></p>

</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>
    