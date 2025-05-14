# API для авторизации пользователей

## Обзор проекта
REST API для регистрации пользователей и получения данных профиля с использованием токенов авторизации.

## Технический стек
- PHP 8.2
- Laravel 12
- SQLite
- Laravel Sanctum для авторизации

## Установка и настройка

### 1. Клонирование репозитория
```bash
git clone [URL репозитория]
cd laravel-test-app
```

### 2. Установка зависимостей
```bash
composer install
```

### 3. Настройка базы данных
В файле `.env` настроены параметры для работы с SQLite:
```
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

### 5. Запуск миграций
```bash
php artisan migrate
```

### 6. Запуск сервера
```bash
php artisan serve
```
После этого API будет доступно по адресу: http://localhost:8000

## API Endpoints

### 1. Регистрация пользователя
**Endpoint**: `POST /api/registration`

**Тело запроса**:
```json
{
    "email": "example@mail.com",
    "password": "секретный_пароль",
    "gender": "male"
}
```

**Параметры**:
- `email` (обязательный): Email-адрес пользователя
- `password` (обязательный): Пароль (минимум 6 символов)
- `gender` (обязательный): Пол пользователя (допустимые значения: "male", "female", "other")

**Успешный ответ** (201 Created):
```json
{
    "message": "User registered successfully",
    "user": {
        "name": "example",
        "email": "example@mail.com",
        "gender": "male",
        "updated_at": "...",
        "created_at": "...",
        "id": 1
    },
    "access_token": "токен_доступа",
    "token_type": "Bearer"
}
```

**Ошибки**:
- 422 Unprocessable Entity - Невалидные данные

```json
{
    "email": [
        "The email has already been taken."
    ]
}
```

### 2. Получение профиля пользователя
**Endpoint**: `GET /api/profile`

**Заголовки**:
- `Authorization: Bearer токен_доступа`

**Успешный ответ** (200 OK):
```json
{
    "user": {
        "id": 1,
        "name": "example",
        "email": "example@mail.com",
        "gender": "male",
        "email_verified_at": null,
        "created_at": "...",
        "updated_at": "..."
    }
}
```

**Ошибки**:
- 401 Unauthorized - Неверный токен или отсутствие авторизации

## Тестирование API

### Через Postman

1. **Регистрация пользователя**:
   - Создайте POST-запрос на `http://localhost:8000/api/registration`
   - Установите Content-Type: application/json
   - В теле запроса отправьте JSON с email, password и gender
   - После успешной регистрации сохраните полученный access_token

2. **Получение профиля**:
   - Создайте GET-запрос на `http://localhost:8000/api/profile`
   - Добавьте заголовок Authorization: Bearer полученный_токен
   - Отправьте запрос для получения данных о профиле

- Для тестирования Вы можете экспортировать готовую коллюкцию в Postman. 
- Коллекция находится в файле Test Laravel - Утяганов Руслан.postman_collection.json

## Структура проекта

Основные файлы:
- `routes/api.php` - Определение API-маршрутов
- `app/Http/Controllers/API/AuthController.php` - Контроллер для обработки запросов
- `app/Models/User.php` - Модель пользователя
- `database/migrations/` - Миграции базы данных

## Реализованная функциональность
- Регистрация пользователей с валидацией данных
- Хеширование паролей для безопасного хранения
- Автоматическая генерация имени пользователя из email
- Аутентификация с использованием токенов (Laravel Sanctum)
- Получение данных профиля пользователя