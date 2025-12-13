<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Контакты</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <nav>
        <a href="index.php">Главная</a>
        <a href="about.php">О нас</a>
        <a href="contact.php">Контакты</a>
    </nav>

    <main>
        <h1>Напиши мне</h1>
        <form action="thanks.php" method="POST">
            <input type="text" name="name" placeholder="Твоё имя" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <textarea name="message" placeholder="Сообщение" rows="5" required></textarea><br>
            <button type="submit">Отправить</button>
        </form>
    </main>
</body>
</html>