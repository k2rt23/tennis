<?php
require_once 'db/config.php';

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['password'], $_POST['confirm_password'], $_POST['token'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Paroolid ei kattu!";
    } else {
        $stmt = $conn->prepare("SELECT email, expires_at FROM password_resets WHERE token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (!$data) {
            $error = "Vigane või aegunud link!";
        } elseif (strtotime($data['expires_at']) < time()) {
            $error = "Taastamislink on aegunud!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $email = $data['email'];

            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed, $email);
            $stmt->execute();

            $stmt = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();

            header("Location: login.php?reset=success");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Parooli muutmine</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #fdf9f3;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .reset-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            color: #3a2e2e;
            margin-bottom: 25px;
        }
        .reset-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #eef4ff;
            box-sizing: border-box;
            font-size: 1em;
        }
        .reset-container button {
            background-color: #d1b28e;
            color: white;
            padding: 12px 20px;
            font-size: 1em;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        .reset-container button:hover {
            background-color: #bb9e79;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="reset-container">
    <h1>Parooli muutmine</h1>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <input type="password" name="password" placeholder="Uus parool" required>
        <input type="password" name="confirm_password" placeholder="Korda parooli" required>
        <button type="submit">Muuda parool</button>
    </form>
</div>
</body>
</html>