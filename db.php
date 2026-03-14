<?php
/**
 * Підключення до бази даних MySQL.
 *
 * Ініціалізує з'єднання через MySQLi, зберігає його в глобальній змінній $conn.
 * Використовується в index.php та admin-скриптах для отримання settings, services, news.
 *
 * @package Lab
 * @global mysqli $conn Глобальне з'єднання з БД
 * @see index.php
 */

$conn = new mysqli(
    getenv('DB_HOST') ?: 'localhost',
    getenv('DB_USER') ?: 'root',
    getenv('DB_PASS') ?: '',
    getenv('DB_NAME') ?: 'lab'
);

if ($conn->connect_error) {
    die('Помилка підключення: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');
