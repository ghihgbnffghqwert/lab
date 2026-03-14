# Інструкція з генерації документації

## Передумови

- PHP 7.4 або новіший
- Composer

## Крок 1. Встановлення залежностей

```bash
composer install
```

Це встановить phpDocumentor у `vendor/`.

## Крок 2. Генерація документації з коду (PHPDoc)

Використовується конфігурація `phpdoc.xml` у корені проєкту.

**Через Composer:**

```bash
composer run-script docs
```

**Або напряму:**

```bash
./vendor/bin/phpdoc run -c phpdoc.xml
```

Згенерована HTML-документація з’явиться у каталозі **`docs/phpdoc/`**. Відкрийте у браузері `docs/phpdoc/index.html`.

## Крок 3. Очищення згенерованих файлів

```bash
composer run-script docs:clean
```

## Що генерується

| Результат        | Шлях              | Опис                                      |
|------------------|-------------------|-------------------------------------------|
| API з PHPDoc     | `docs/phpdoc/`    | Сайт документації по класах/функціях      |
| Архітектура      | `docs/ARCHITECTURE.md` | Ручний опис компонентів та взаємодії |
| API (OpenAPI)    | `docs/api/openapi.yaml` | Специфікація ендпоінтів форм/контактів |
| Swagger UI       | `docs/swagger.html`   | Інтерактивний перегляд OpenAPI          |

## Контроль якості документації

- Переконайтесь, що всі публічні функції/методи мають блоки PHPDoc з `@param` та `@return` (де доречно).
- Після змін у коді повторно запустіть генерацію (`composer run-script docs`) та перевірте зміни в `docs/phpdoc/`.

## CI/CD

У репозиторії налаштовано GitHub Actions (`.github/workflows/docs.yml`): при push у гілку `main` збирається документація; при наявності GitHub Pages її можна публікувати з артефакту `docs/phpdoc/`.
