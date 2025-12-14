<?php
require 'config.php';
session_start();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => ''];

if ($_POST['action'] === 'register') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $response['message'] = 'Заполните все поля';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            if ($stmt->fetch()) {
                $response['message'] = 'Логин или email уже используются';
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $hashed]);
                $response['success'] = true;
            }
        } catch (Exception $e) {
            $response['message'] = 'Ошибка сервера';
        }
    }
} elseif ($_POST['action'] === 'login') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $response['success'] = true;
        } else {
            $response['message'] = 'Неверный логин или пароль';
        }
    } catch (Exception $e) {
        $response['message'] = 'Ошибка сервера';
    }
}

echo json_encode($response);
?>