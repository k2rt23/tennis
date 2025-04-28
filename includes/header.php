<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <nav>
        <a href="index.php">Avaleht</a>
        <a href="trainings.php">Treeningud ja hinnad</a>
        <a href="contact.php">Kontakt</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="my_bookings.php">Minu broneeringud</a>
            <a href="logout.php">Logi välja</a>
        <?php else: ?>
            <a href="login.php">Logi sisse</a>
            <a href="register.php">Registreeru</a>
        <?php endif; ?>
    </nav>
</header>