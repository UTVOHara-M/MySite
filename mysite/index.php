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
            </div>

            <div class="nav-right">
                <?php if (isset($_SESSION['username'])): ?>
                    <span class="user-greeting">Привет, <?= htmlspecialchars($_SESSION['username']) ?></span>
                    <a href="logout.php" class="btn-logout">Выйти</a>
                <?php else: ?>
                    <button id="authBtn" class="btn-auth">
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        Вход / Регистрация
                    </button>
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
</body>
</html>