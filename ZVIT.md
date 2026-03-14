# Звіт з лабораторної роботи 5: Документування коду

**Дисципліна:** технічна підтримка / документування коду  
**Тема:** Документування програмного коду (PHP-проєкт)  
**Репозиторій:** https://github.com/ghihgbnffghqwert/lab  

---

## 1. Посилання на коміти, що додають документацію

Після ініціалізації репозиторію та першого push усі зміни документації можна переглянути в історії комітів. Рекомендовані повідомлення комітів:

- `feat: add PHPDoc to index.php, db.php, lib/helpers.php, actions/contact.php`
- `docs: add README with documentation guidelines and docs/generate_docs.md`
- `docs: add STANDARDS_AND_TOOLS.md and ARCHITECTURE.md`
- `docs: add OpenAPI spec and Swagger UI (docs/api, docs/swagger.html)`
- `ci: add GitHub Actions workflow for documentation generation`

У репозиторії: **Code → Commits** — там будуть посилання на конкретні коміти.

---

## 2. Інструкція з генерації документації

Файл: **`docs/generate_docs.md`**

Коротко:

1. Встановити залежності: `composer install`
2. Згенерувати документацію: `composer run-script docs`
3. Відкрити у браузері: `docs/phpdoc/index.html`

Детальний опис кроків, очищення та інтеграції з CI — у самому файлі.

---

## 3. Згенерована документація окремим архівом

- Каталог зі згенерованою документацією: **`docs/phpdoc/`**
- Архів для здачі: **`docs-phpdoc.zip`** (створюється командою нижче).

Команда для створення архіву (виконати в корені проєкту):

```bash
cd "/Users/kostiantyn/Desktop/заказ" && zip -r docs-phpdoc.zip docs/phpdoc
```

Архів містить HTML-документацію по коду (файли, функції, описи з PHPDoc).

---

## 4. Інтеграція з процесом збірки

- **Конфігурація:** `phpdoc.xml` — налаштування phpDocumentor (вихідний каталог, кеш, виключення).
- **Скрипти:** у `composer.json`:
  - `composer run-script docs` — генерація документації в `docs/phpdoc/`;
  - `composer run-script docs:clean` — видалення згенерованих файлів і кешу.
- **CI/CD:** `.github/workflows/docs.yml` — при push у `main`/`master` виконується `composer install` та `composer run-script docs`, артефакт з каталогом `docs/phpdoc` зберігається в GitHub Actions.

---

## 5. API-документація (застосовно)

- **Специфікація OpenAPI:** `docs/api/openapi.yaml`  
  Описано ендпоінт контактної форми: `POST /actions/contact.php` (параметри name, email, message, формат та приклади).
- **Інтерактивний перегляд:** `docs/swagger.html`  
  Підключено Swagger UI для перегляду та перевірки запитів/відповідей згідно з OpenAPI.

Перевірка інтерактивних прикладів: відкрити `docs/swagger.html` у браузері (при локальному сервері або після розгортання сайту) та переконатися, що форма відповідає опису в специфікації.

---

## 6. Посилання на розгорнуту документацію (якщо застосовно)

Після налаштування GitHub Pages для репозиторію можна публікувати згенеровану документацію з гілки `main` (каталог `docs/phpdoc` або артефакт зі workflow). Посилання тоді матиме вигляд:  
`https://ghihgbnffghqwert.github.io/lab/` (шлях залежить від налаштувань Pages).

Якщо Pages не налаштовували — у звіті залишається посилання на репозиторій та архів `docs-phpdoc.zip`.

---

## Виконання завдань (відповідність умові роботи)

| Завдання | Виконання |
|----------|-----------|
| Дослідити стандарти документування для PHP | Огляд у `docs/STANDARDS_AND_TOOLS.md` (PHPDoc, рекомендації) |
| Огляд інструментів автогенерації | Таблиця інструментів у `docs/STANDARDS_AND_TOOLS.md`, обрано phpDocumentor |
| Документація мінімум 3 ключових елементів | PHPDoc додано до `index.php`, `db.php`, `lib/helpers.php` (функція `h`), `actions/contact.php` |
| Модифікація README — що і як документувати | Розділ у `README.md` + посилання на `docs/generate_docs.md` |
| Встановлення та налаштування інструменту | phpDocumentor у `composer.json`, конфіг `phpdoc.xml` |
| Документація публічних інтерфейсів | Усі перелічені файли/функції описані PHPDoc |
| Генерація документації та архів | `docs/phpdoc/`, інструкція в `docs/generate_docs.md`, архів `docs-phpdoc.zip` |
| Інструкція з генерації | `docs/generate_docs.md` |
| Контроль якості документації | Рекомендації в `docs/generate_docs.md`; можливе підключення PHPStan/Psalm |
| Документація архітектури та бізнес-логіки | `docs/ARCHITECTURE.md` |
| OpenAPI (Swagger) для ендпоінтів | `docs/api/openapi.yaml`, опис форми контактів |
| Swagger UI та перевірка прикладів | `docs/swagger.html` |
| CI/CD для генерації документації | `.github/workflows/docs.yml` |

---

**Підпис:** _________________  
**Дата:** 14.03.2025
