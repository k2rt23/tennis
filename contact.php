<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

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


<main class="contact">
    <h1>Kontakt</h1>

    <div class="contact-info">
        <p><strong>E-mail:</strong> latennis@gmail.com</p>
        <p><strong>Telefon:</strong> +372 5555 5555</p>
        <p><strong>Asukoht:</strong> Tallinn, Eesti</p>
    </div>

    <h2>Võta ühendust</h2>
    <div class="contact-form">
        <form action="contact.php" method="POST">
            <input type="text" name="name" placeholder="Sinu nimi" required>
            <input type="email" name="email" placeholder="Sinu e-mail" required>
            <textarea name="message" placeholder="Sõnum" rows="5" required></textarea>
            <button type="submit">Saada</button>
        </form>
    </div>

    <h2>Meie asukoht</h2>
<p>Asume Krulli kvartalis.</p>


<div id="map" style="width: 100%; height: 400px; border-radius: 10px; margin-bottom: 30px;"></div>

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_1D0fjh4Xc9mMC02-Qr7auJkgzPhySVg&callback=initMap">
</script>

<script>
function initMap() {
  const location = { lat: 59.44585, lng: 24.72098 }; 
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 17,
    center: location,
    disableDefaultUI: true 
    });
    const marker = new google.maps.Marker({
      position: location,
      map: map,
      title: "Franz Krulli Tennisemaja",
    });
  }
</script>
