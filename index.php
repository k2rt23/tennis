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
    <title>Tennisetreeningud</title>
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


<main>
<section class="hero">
  <h1>LA Tenniseklubi – koht, kus naised kohtuvad mängu, liikumise ja sõprusega</h1>
  <p>Klubi on loodud just naistele – toetav, elegantne ja turvaline keskkond, kus sport, hea enesetunne ja sotsiaalsus käivad käsikäes.</p>
  <p>Lisaks treeningutele toimuvad klubis naiste tenniseõhtud, sotsiaalsed turniirid, tenniselaagrid ja klubisündmused. See on rohkem kui trenn – see on sinu klubi.</p>
</section>


<section class="vibe-gallery">
  <div class="vibe-grid">
    <img src="img/tennis1.jpg" alt="Tennis 1">
    <img src="img/tennis2.jpg" alt="Tennis 2">
    <img src="img/tennis3.jpg" alt="Tennis 3">
    <img src="img/tennis4.jpg" alt="Tennis 4">
    <img src="img/tennis5.jpg" alt="Tennis 5">
    <img src="img/tennis6.jpg" alt="Tennis 6">
  </div>
  <p class="vibe-caption">"Tennis. Esteetika. Naised."</p>
</section>


    <section class="content">
        <h2>Tenniseklubi lugu</h2>
        <p>LA Tenniseklubi sai alguse lihtsast soovist – luua ruum, kus naised saaksid tennise kaudu liikuda, 
            lõõgastuda ja üksteisega päriselt kohtuda. Meie treeningud on mitmekesised, kuid rõhk on alati 
            heal enesetundel, toetaval kogukonnal ja rõõmsal meelel.</p>
    </section>

    <section class="content">
        <h2>Mida me pakume?</h2>
        <p>Pakume treeninguid algajatele, harrastajatele ja edasijõudnutele – iga naine leiab endale sobiva tempo ja taseme.</p>
        <ul>
  <li>✓ Personaalsed ja grupitrennid vastavalt tasemele</li>
  <li>✓ Naiste tenniseõhtud ja sotsiaalsed mängud</li>
  <li>✓ Hooajalised turniirid ja klubisisesed matšid</li>
  <li>✓ Tenniselaagrid ja nädalavahetuse retriidid</li>
</ul>

</section>

    <section class="cta-booking">
    <h2>Valmis alustama treeningutega?</h2>
    <p>Leia endale sobiv aeg ja tule platsile – ootame sind!</p>
    <a class="cta-button" href="booking.php">Broneeri trenn</a>
  </section>
</main>

<footer>
    <p>&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
</footer>

</body>
</html>
