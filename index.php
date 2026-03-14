<?php
/**
 * Головна сторінка сайту — лендінг з секціями: герой, про компанію, послуги, новини, контакти, чат.
 *
 * Підключає підключення до БД, хелпери, завантажує налаштування сайту, послуги та новини з БД
 * і виводить HTML-шаблон. Форма контакту відправляється на actions/contact.php.
 *
 * @package Lab
 * @see db.php
 * @see lib/helpers.php
 * @see actions/contact.php
 */

define('DIR', __DIR__);
require DIR . '/db.php';
require DIR . '/lib/helpers.php';

if (defined('DEMO_MODE') && DEMO_MODE && !$conn) {
    $site = [
        'site_name' => 'Лабовий сайт',
        'hero_title' => 'Ласкаво просимо',
        'hero_subtitle' => 'Документування коду — лабораторна робота 5',
        'about_text' => 'Демонстрація лендінгу з секціями: про компанію, послуги, новини, контакти, чат.',
        'about_small' => 'Режим без БД (демо).',
        'about_image' => 'public/no-image.png',
    ];
    $services = new class implements Iterator {
        private $rows = [
            ['title' => 'Консультація', 'description' => 'Опис послуги 1.', 'image' => ''],
            ['title' => 'Розробка', 'description' => 'Опис послуги 2.', 'image' => ''],
            ['title' => 'Підтримка', 'description' => 'Опис послуги 3.', 'image' => ''],
        ];
        private $i = 0;
        public function fetch_assoc() { $r = $this->rows[$this->i++] ?? null; return $r; }
        public function rewind() { $this->i = 0; }
        public function current() { return $this->rows[$this->i] ?? null; }
        public function key() { return $this->i; }
        public function next() { $this->i++; }
        public function valid() { return isset($this->rows[$this->i]); }
    };
    $newsDate = date('Y-m-d');
    $news = new class($newsDate) implements Iterator {
        private $rows;
        private $i = 0;
        public function __construct($d) {
            $this->rows = [
                ['title' => 'Новина 1', 'text' => 'Текст новини.', 'date' => $d, 'image' => 'no-image.png'],
                ['title' => 'Новина 2', 'text' => 'Ще одна новина.', 'date' => $d, 'image' => 'no-image.png'],
            ];
        }
        public function fetch_assoc() { $r = $this->rows[$this->i++] ?? null; return $r; }
        public function rewind() { $this->i = 0; }
        public function current() { return $this->rows[$this->i] ?? null; }
        public function key() { return $this->i; }
        public function next() { $this->i++; }
        public function valid() { return isset($this->rows[$this->i]); }
    };
} else {
    $site = $conn->query("SELECT * FROM settings LIMIT 1")->fetch_assoc();
    $services = $conn->query("SELECT * FROM services");
    $news = $conn->query("SELECT * FROM news ORDER BY date DESC");
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= h($site['site_name']) ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="public/styles.css">
<style>
  .news-thumb {
    width: 100%;
    height: 220px;
    object-fit: cover;
    border-top-left-radius: .5rem;
    border-top-right-radius: .5rem;
  }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#"><?= h($site['site_name']) ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="#about">Про компанію</a></li>
        <li class="nav-item"><a class="nav-link" href="#services">Послуги</a></li>
        <li class="nav-item"><a class="nav-link" href="#news">Новини</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Контакти</a></li>
        <li class="nav-item"><a class="btn btn-light ms-lg-3" href="admin/">Адмін</a></li>
      </ul>
    </div>
  </div>
</nav>

<header class="hero text-white text-center">
  <div class="overlay"></div>
  <div class="container position-relative">
    <h1 class="display-5 fw-bold mb-2"><?= h($site['hero_title']) ?></h1>
    <p class="lead mb-4"><?= h($site['hero_subtitle']) ?></p>
    <a href="#contact" class="btn btn-outline-light">Зв'язатися</a>
  </div>
</header>

<section id="about" class="py-5">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-7">
        <h2 class="text-success">Про компанію</h2>
        <p class="fs-5"><?= h($site['about_text']) ?></p>
        <p class="text-muted"><?= h($site['about_small']) ?></p>
      </div>
      <div class="col-lg-5">
        <img src="<?= h($site['about_image']) ?>" class="img-fluid rounded-4" alt="">
      </div>
    </div>
  </div>
</section>

<section id="services" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-success mb-4">Послуги</h2>
    <div class="row g-4">
      <?php while ($s = $services->fetch_assoc()): ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <?php if ($s['image']): ?>
            <img src="uploads/services/<?= h($s['image']) ?>" class="news-thumb" alt="<?= h($s['title']) ?>">
          <?php else: ?>
            <img src="public/no-image.png" class="news-thumb" alt="Без зображення">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= h($s['title']) ?></h5>
            <p class="card-text text-muted"><?= h($s['description']) ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>


<section id="news" class="py-5">
  <div class="container">
    <h2 class="text-success mb-4">Новини</h2>
    <div class="row g-4">
      <?php while ($n = $news->fetch_assoc()): ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <?php if (!empty($n['image'])): ?>
          <img src="uploads/news/<?= h($n['image']) ?>" class="news-thumb" alt="<?= h($n['title']) ?>">
          <?php else: ?>
          <img src="public/no-image.png" class="news-thumb" alt="<?= h($n['title']) ?>">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= h($n['title']) ?></h5>
            <div class="text-muted small mb-2"><?= h($n['date']) ?></div>
            <p class="card-text text-muted"><?= h($n['text']) ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<section id="contact" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-success mb-3">Контакти</h2>
    <p class="text-muted">Заповніть форму - відповімо протягом робочого дня.</p>
    <form class="row g-3" method="post" action="actions/contact.php">
      <div class="col-md-6"><input class="form-control" name="name" placeholder="Ваше ім'я" required></div>
      <div class="col-md-6"><input class="form-control" type="email" name="email" placeholder="Електронна пошта" required></div>
      <div class="col-12"><textarea class="form-control" name="message" rows="4" placeholder="Повідомлення" required></textarea></div>
      <div class="col-12"><button class="btn btn-success">Надіслати</button></div>
    </form>
  </div>
</section>

<section id="chat" class="py-5">
  <div class="container">
    <h2 class="text-success mb-3">Чат</h2>
    <div id="chatBox" class="border rounded-3 bg-white" style="height:260px;overflow:auto"></div>
    <form class="row g-2 mt-2" onsubmit="chatSend(event)">
      <div class="col-md-3"><input class="form-control" name="name" placeholder="Ваше ім'я" required></div>
      <div class="col-md-7"><input class="form-control" name="text" placeholder="Ваше повідомлення..." required></div>
      <div class="col-md-2 d-grid"><button class="btn btn-success">Надіслати</button></div>
    </form>
  </div>
</section>

<footer class="py-4 text-white bg-dark">
  <div class="container d-flex justify-content-between">
    <div>© <?= date('Y') ?> <?= h($site['site_name']) ?></div>
    <div><a href="admin/" class="link-light">Адмін</a></div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/chat.js"></script>
</body>
</html>
