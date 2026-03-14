<?php
/**
 * Обробник форми «Контакти» на головній сторінці.
 *
 * Приймає POST: name, email, message. Валідує, зберігає у БД (таблиця contact_requests)
 * або відправляє листа. Після обробки виконує редірект назад з flash-повідомленням.
 *
 * @package Lab
 * @see index.php секція #contact
 */

define('DIR', dirname(__DIR__));
require DIR . '/db.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email || !$message) {
    header('Location: /?contact=error');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: /?contact=invalid');
    exit;
}

$stmt = $conn->prepare("INSERT INTO contact_requests (name, email, message, created_at) VALUES (?, ?, ?, NOW())");
if ($stmt) {
    $stmt->bind_param('sss', $name, $email, $message);
    $stmt->execute();
    $stmt->close();
}

header('Location: /?contact=ok');
exit;
