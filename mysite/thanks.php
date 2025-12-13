<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    try {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
        $stmt->execute([
            ':name'    => $name,
            ':email'   => $email,
            ':message' => $message
        ]);

        echo "<!DOCTYPE html>
<html lang='ru'>
<head>
    <meta charset='UTF-8'>
    <title>Спасибо!</title>
    <link rel='stylesheet' href='assets/style.css'>
</head>
<body>
    <nav>
        <a href='index.php'>Главная</a>
        <a href='about.php'>О нас</a>
        <a href='contact.php'>Контакты</a>
    </nav>
    <main>
        <h1>Спасибо, " . htmlspecialchars($name) . "!</h1>
        <p>Сообщение успешно сохранено </p>
        <p><a href='contact.php'>← Написать ещё</a> | <a href='index.php'>На главную</a></p>
    </main>
</body>
</html>";
    } catch (PDOException $e) {
        echo "Ошибка сохранения: " . $e->getMessage();
    }
} else {
    header('Location: contact.php');
    exit;
}
?>