#!/bin/bash
cd "$(dirname "$0")"
echo "Відкрийте в браузері: http://localhost:8765/"
echo "Зупинити сервер: Ctrl+C"
php -S localhost:8765
