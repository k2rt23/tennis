<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
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
        h1 {
            text-align: center;
        }
        .contact-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .contact-form {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        iframe {
            width: 100%;
            height: 300px;
            border: 0;
        }
        footer {
            text-align: center;
            padding: 10px;
            background: #333;
            color: white;
            margin-top: 20px;
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
        <h1>Kontakt</h1>

        <div class="contact-info">
            <p><strong>E-mail:</strong> sinuemail@example.com</p>
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
        <p> Asume Krulli kvartalis.
    </main>

    <footer>
        <p>&copy; 2025 Tennisetreeningud - Kõik õigused kaitstud</p>
    </footer>
</body>
</html>
