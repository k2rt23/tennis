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
    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $trainer = $_POST['trainer'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE bookings SET date = ?, time = ?, trainer = ?, name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $date, $time, $trainer, $name, $email, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Broneering uuendatud!'); window.location.href='admin_bookings.php';</script>";
    } else {
        echo "Viga uuendamisel: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muuda broneeringut</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Muuda broneeringut</h1>
    <form method="post">
        <input type="hidden" name="id" value="<?= $booking['id'] ?>">

        <label>Kuupäev:</label>
        <input type="date" name="date" value="<?= $booking['date'] ?>" required><br>

        <label>Kellaaeg:</label>
        <input type="time" name="time" value="<?= $booking['time'] ?>" required><br>

        <label>Treener:</label>
        <select name="trainer" required>
            <option value="trainer1" <?= ($booking['trainer'] == 'trainer1') ? 'selected' : '' ?>>Kärt-Triin Laagus</option>

        <label>Nimi:</label>
        <input type="text" name="name" value="<?= $booking['name'] ?>" required><br>

        <label>E-mail:</label>
        <input type="email" name="email" value="<?= $booking['email'] ?>" required><br>

        <button type="submit">Salvesta muudatused</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
