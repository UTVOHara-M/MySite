<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О нас</title>
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
        <h1>О нас</h1>
        <p>Это тестовый проект на чистом PHP с Laragon.</p>
        <p>Мы изучаем веб-разработку в 2025 году!</p>
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