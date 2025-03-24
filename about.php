<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minust</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
            background-color: #333;
            padding: 20px;
            text-align: center;
        }

        header nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 1.2em;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        .hero {
            background: url('img/coach.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 3em;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .cta-button {
            padding: 12px 25px;
            background-color: #d1b28e;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1em;
        }

        .cta-button:hover {
            background-color: #bfa374;
        }

        section {
            padding: 40px 20px;
            text-align: center;
        }

        section h2 {
            font-size: 2em;
            margin-bottom: 15px;
            color: #333;
        }

        section p, section ul {
            font-size: 1.2em;
            margin-bottom: 15px;
            line-height: 1.5;
            color: #666;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<header>
    <nav>
        <a href="index.php">Avaleht</a>
        <a href="about.php">Minust</a>
        <a href="trainings.php">Treeningud</a>
        <a href="pricing.php">Hinnakiri</a>
        <a href="contact.php">Kontakt</a>
    </nav>
</header>

<main>
    <div class="profile-image">
        <img src="img/profile.jpg" alt="Minu pilt">
    </div>
    <h1>Tere, mina olen Kärt-Triin Laagus!</h1>
    <p>
        Olen treener, kelle eesmärk on aidata igas vanuses ja tasemel mängijaid oma oskusi arendada.
        Minu treeningutel saad õppida tehnilisi oskusi, strateegiat ja mängu mõistmist.
    </p>

    <h2>Minu kogemus</h2>
    <p>
        Mul on üle 15 aasta kogemust tennisemängijana ja olen juhendanud nii algajaid kui ka edasijõudnuid.
        Olen töötanud mitmetes klubides ja osalenud erinevatel võistlustel.
    </p>

    <h2>Miks valida minu treeningud?</h2>
    <ul>
        <li>Personaalsed treeningkavad vastavalt sinu tasemele.</li>
        <li>Fookus tehnilisele ja taktikalisele arengule.</li>
        <li>Sõbralik ja motiveeriv keskkond.</li>
    </ul>
</main>

<footer>
    <p>&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
</footer>

</body>
</html>
