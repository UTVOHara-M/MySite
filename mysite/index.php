<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mysite — Главная</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <nav>
        <a href="index.php">Главная</a>
        <a href="about.php">О нас</a>
        <a href="contact.php">Контакты</a>
    </nav>

    <main>
        <p>Сегодня: <?= date('d.m.Y') ?></p>
    </main>
</body>
</html>