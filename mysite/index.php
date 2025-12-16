<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Mysite — Главная</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="nav-left">
                <a href="index.php">Главная</a>
                <a href="about.php">О нас</a>
                <a href="contact.php">Контакты</a>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <a href="admin.php">Админка</a>
                <?php endif; ?>
            </div>

            <div class="nav-right">
                <?php if (isset($_SESSION['username'])): ?>
                    Привет, <?= htmlspecialchars($_SESSION['username']) ?>!
                    <a href="logout.php" class="btn-logout" >Выйти</a>
                <?php else: ?>
                    <button id="openAuthModal" class="btn-auth">Вход / Регистрация</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <h1>Добро пожаловать на Mysite!</h1>
        <p>Простой сайт на PHP с формой обратной связи и авторизацией.</p>
        <p>Сегодня: <?= date('d.m.Y') ?></p>
    </main>

    <?php include 'auth_modal.php'; ?>

    <script>
        document.getElementById('openAuthModal')?.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('authModal').style.display = 'flex';
        });
    </script>
</body>
</html>