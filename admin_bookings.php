<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); 
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$dbname = "tennis_db";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse viga: " . $conn->connect_error);
}

$sql = "SELECT * FROM bookings ORDER BY date, time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broneeringud</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f8f9fa;
        }
        header {
            background: #333;
            padding: 10px;
            text-align: center;
        }
        header nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        main {
            max-width: 900px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #007bff;
            color: white;
        }
        .action-links a {
            margin-right: 10px;
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
        .logout-btn {
            float: right;
            color: white;
            background: red;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
        }
        .logout-btn:hover {
            background: darkred;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Avaleht</a>
            <a href="trainings.php">Minust</a>
            <a href="trainings.php">Treeningud</a>
            <a href="pricing.php">Hinnakiri</a>
            <a href="contact.php">Kontakt</a>
            <a href="logout.php" class="logout-btn">Logi välja</a>
        </nav>
    </header>

    <main>
        <h1>Broneeringud</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Kuupäev</th>
                <th>Kellaaeg</th>
                <th>Treener</th>
                <th>Nimi</th>
                <th>E-mail</th>
                <th>Tegevused</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
                    <td><?= htmlspecialchars($row['time']) ?></td>
                    <td><?= htmlspecialchars($row['trainer']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td class="action-links">
                        <a href="edit_booking.php?id=<?= $row['id'] ?>" style="color:blue;">Muuda</a> |
                        <a href="delete_booking.php?id=<?= $row['id'] ?>" style="color:red;" onclick="return confirm('Kas oled kindel, et soovid broneeringu kustutada?');">Kustuta</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </main>

    <footer>
        <p style="text-align:center;">&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
    </footer>
</body>
</html>

<?php $conn->close(); ?>
