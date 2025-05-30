<?php
require_once 'db/config.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $token = bin2hex(random_bytes(16));
        $expires = date("Y-m-d H:i:s", strtotime('+1 hour'));

        $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $token, $expires);
        $stmt->execute();

        $resetLink = "https://latennis.ee/reset_password.php?token=$token";
        $subject = "Parooli taastamise link";
        $message = "Tere!\n\nParooli taastamiseks vajuta allolevale lingile:\n$resetLink\n\nLink aegub 1 tunni jooksul.";
        $headers = "From: no-reply@latennis.ee\r\n" .
                   "Content-Type: text/plain; charset=utf-8";

        mail($email, $subject, $message, $headers);

        $success = "✅ Taastamislink saadeti e-mailile.";
    } else {
        $error = "❌ Seda e-maili ei leitud.";
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Parooli taastamine</title>
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
        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #eef4ff;
            box-sizing: border-box;
            font-size: 1em;
        }
        button {
            background-color: #d1b28e;
            color: white;
            padding: 12px 20px;
            font-size: 1em;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #bb9e79;
        }
        .message {
            margin-top: 15px;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h1>Taasta parool</h1>

        <?php if (!empty($success)) echo "<div class='message success'>$success</div>"; ?>
        <?php if (!empty($error)) echo "<div class='message error'>$error</div>"; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Sisesta oma e-mail" required>
            <button type="submit">Saada taastamislink</button>
        </form>
    </div>
</body>
</html>
