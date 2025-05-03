<?php
session_start();
require_once 'db/config.php';

if (!isset($_SESSION['user_id'])) {
    echo '
    <!DOCTYPE html>
    <html lang="et">
    <head>
        <meta charset="UTF-8">
        <title>Ligipääs keelatud</title>
        <link rel="stylesheet" href="css/style.css">
        <style>
            body {
                background-color: #fdf9f3;
                font-family: "Segoe UI", sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .message-box {
                background: white;
                padding: 40px;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                text-align: center;
            }
            h2 {
                color: #3a2e2e;
                margin-bottom: 20px;
            }
            a.button {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 20px;
                background-color: #d1b28e;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                font-weight: bold;
            }
            a.button:hover {
                background-color: #bb9e79;
            }
        </style>
    </head>
    <body>
        <div class="message-box">
            <h2>Sa pead olema sisse logitud, et broneerida trenn.</h2>
            <a class="button" href="login.php">Logi sisse</a>
        </div>
    </body>
    </html>';
    exit();
}

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $kuupaev = $_POST['date'];
    $kellaaeg = $_POST['time'];
    $treener = $_POST['trainer'];
    $nimi = $_POST['name'];
    $email = $_POST['email'];
    $kasutaja_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, date, time, trainer, name, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $kasutaja_id, $kuupaev, $kellaaeg, $treener, $nimi, $email);

    if ($stmt->execute()) {
        $_SESSION['booking_success'] = "✅ Broneering edukalt salvestatud!";
        header("Location: my_bookings.php");
        exit();
    } else {
        $error = "Midagi läks valesti. Palun proovi uuesti.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broneeri treening</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
<div class="booking-container">
    <h1>Broneeri treening</h1>
    <p>Vali sobiv kuupäev ja kellaaeg ning täida oma andmed.</p>

    <?php if (!empty($error)): ?>
        <p class="error-message"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="booking.php">

        <label>Vali kuupäev:</label>
        <input type="date" name="date" id="datePicker" required>

        <label>Vali kellaaeg:</label>
        <select name="time" required>
            <option value="">-- Vali kellaaeg --</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
        </select>

        <label>Treener:</label>
        <select name="trainer" required>
            <option value="Kärt-Triin Laagus">Kärt-Triin Laagus</option>
        </select>

        <label>Nimi:</label>
        <input type="text" name="name" required>

        <label>E-mail:</label>
        <input type="email" name="email" required>

        <button type="submit">Broneeri</button>
    </form>
</div>
</main>

<script>
    document.getElementById('datePicker').addEventListener('input', function() {
        const date = new Date(this.value);
        const day = date.getDay(); 
        if (day === 0 || day === 6) {
            alert('Vali kuupäev esmaspäevast reedeni!');
            this.value = '';
        }
    });
</script>

</body>
</html>