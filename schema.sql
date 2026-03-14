-- Схема БД для лендінгу (на вимогу документування та розгортання)
CREATE TABLE IF NOT EXISTS settings (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  site_name VARCHAR(255) NOT NULL DEFAULT 'Сайт',
  hero_title VARCHAR(255) NOT NULL DEFAULT '',
  hero_subtitle VARCHAR(255) NOT NULL DEFAULT '',
  about_text TEXT,
  about_small VARCHAR(500),
  about_image VARCHAR(500)
);

CREATE TABLE IF NOT EXISTS services (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  image VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS news (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  text TEXT,
  date DATE,
  image VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS contact_requests (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  created_at DATETIME NOT NULL
);

INSERT INTO settings (id, site_name, hero_title, hero_subtitle, about_text, about_small) VALUES
(1, 'Лабовий сайт', 'Ласкаво просимо', 'Підзаголовок', 'Текст про компанію.', 'Додатковий текст.');
