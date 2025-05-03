<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'trainer') {
    header("Location: login.php");
    exit();
}

require_once 'db/config.php';

$sql = "SELECT * FROM bookings ORDER BY date, time";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Treeneri vaade</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .dashboard {
            max-width: 1000px;
            margin: 60px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        h1 {
            color: #3a2e2e;
            text-align: center;
        }
    </style>
</head>
<body>

<?php include 'includes/header.php'; ?>

<div class="dashboard">
    <h1 style="text-align: center; margin-bottom: 30px;">
        Tere tulemast, treener <?= htmlspecialchars($_SESSION['user_name']); ?>!
    </h1>

    <h2 style="text-align: center; color: #3a2e2e;">Kõik broneeringud</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Kuupäev</th>
                <th>Kellaaeg</th>
                <th>Treener</th>
                <th>Nimi</th>
                <th>E-mail</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= date('d.m.Y', strtotime($row['date'])) ?></td>
                    <td><?= htmlspecialchars($row['time']) ?></td>
                    <td><?= htmlspecialchars($row['trainer']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align: center;">Broneeringuid veel ei ole.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>

</body>
</html>