<?php require 'config.php'; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка</title>
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
                <span class="user-greeting">Привет, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="btn-logout">Выйти</a>
            </div>
        </div>
    </header>

    <main>
        <h1>Админка: Сообщения от пользователей</h1>

        <?php
        if ($_SESSION['role'] !== 'admin') {
            echo "<p>Доступ запрещён.</p>";
            exit;
        }

        $stmt = $pdo->query("SELECT * FROM users WHERE message != '' ORDER BY created_at DESC");
        if ($stmt->rowCount() > 0): ?>
            <table class="admin-table">
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Сообщение</th>
                    <th>Дата</th>
                    <th>Действие</th>
                </tr>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
                            <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Удалить сообщение?')" class="delete-btn" >Удалить</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Пока нет сообщений.</p>
        <?php endif; ?>

        <?php
        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            $stmt = $pdo->prepare("UPDATE users SET message = '' WHERE id = ?");
            $stmt->execute([$id]);
            header('Location: admin.php');
            exit;
        }
        ?>
    </main>

    <?php include 'auth_modal.php'; ?>
</body>
</html>