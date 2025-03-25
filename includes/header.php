<?php session_start(); ?>
<header>
    <nav>
        <a href="index.php">Avaleht</a>
        <a href="trainings.php">Treeningud</a>
        <a href="contact.php">Kontakt</a>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php">Logi sisse</a>
            <a href="register.php">Registreeru</a>
            <?php else: ?>
    <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <a href="admin_bookings.php">Admin ala</a>
    <?php else: ?>
        <a href="my_bookings.php">Minu broneeringud</a>
    <?php endif; ?>
    <a href="logout.php">Logi välja</a>
<?php endif; ?>   