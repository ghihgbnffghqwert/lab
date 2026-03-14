<?php
/**
 * Допоміжні функції для безпечного виводу та спрощення логіки.
 *
 * @package Lab
 */

/**
 * Екранує HTML-спецсимволи для безпечного виводу в HTML.
 *
 * Запобігає XSS при виводі даних з БД або користувацького вводу.
 * Використовується для всіх текстових полів у шаблонах (index.php).
 *
 * @param string $s Рядок для виводу (наприклад, з БД або $_POST)
 * @return string Екранований рядок, безпечний для вставки в HTML
 *
 * @example
 * <title><?= h($site['site_name']) ?></title>
 */
function h($s)
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}
