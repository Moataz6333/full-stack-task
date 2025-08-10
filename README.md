# Full Stack Application (Laravel 12 & Vue 3)

This project is a full stack web application built with Laravel 12 (API backend) and Vue 3 (frontend). The Vue project is located in the root folder, and the Laravel backend is in the `laravel-app` directory.

## Project Structure

```
/               # Vue 3 frontend
/laravel-app/   # Laravel 12 backend (API)
```

## Getting Started

### Prerequisites

- Node.js & npm
- Composer
- PHP >= 8.2
- MySQL or other supported database

### 1. Setup Laravel Backend

```sh
cd laravel-app
cp .env.example .env
composer install
php artisan key:generate
# Configure your .env database settings
php artisan migrate --seed
php artisan serve
```

admin: 
email : admin@admin.com 
password: password
user: 
email : user@user.com 
password: password

### 2. Setup Vue Frontend

```sh
# From the project root
npm install
npm run dev
```

The Vue app will be available at http://localhost:5173 (or as shown in the terminal)

## API Documentation

You can find the Postman collection and API documentation here: https://documenter.getpostman.com/view/36354325/2sB3BEnAQX

[Add your Postman documentation link or file here]

---

Feel free to contribute or open issues for improvements!
