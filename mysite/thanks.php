<?php require 'config.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Спасибо!</title>
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
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <a href="admin.php">Админка</a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn-logout" >Выйти</a>
                <?php else: ?>
                    <button id="openAuthModal" class="btn-auth">Вход / Регистрация</button>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);

            $stmt = $pdo->prepare("UPDATE users SET message = :message WHERE id = :id");
            $stmt->execute([':message' => $message, ':id' => $_SESSION['user_id']]);

            echo "<h1>Спасибо, " . htmlspecialchars($name) . "!</h1>";
            echo "<p>Сообщение сохранено.</p>";
            echo '<div style="text-align: center; margin-top: 40px;">';
            echo '<a href="contact.php" style="padding: 12px 30px; background: #00ccff; color: black; text-decoration: none; border-radius: 12px; margin: 0 15px;">← Написать ещё</a>';
            echo '<a href="index.php" style="padding: 12px 30px; background: #00ccff; color: black; text-decoration: none; border-radius: 12px; margin: 0 15px;">На главную</a>';
            echo '</div>';
        } else {
            header('Location: contact.php');
            exit;
        }
        ?>
    </main>

    <?php include 'auth_modal.php'; ?>
</body>
</html>