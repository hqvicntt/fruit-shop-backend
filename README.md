# 🥭 Fruit Shop Management System - Backend API

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)
![Railway](https://img.shields.io/badge/Deployed%20on-Railway-0B0D0E?logo=railway&logoColor=white)

A centralized RESTful API server built with Laravel and MySQL to manage fruit inventory, process retail orders, handle real-time bank transfer webhooks via **SePay**, and secure administrative operations using **Laravel Sanctum**.

---

## ✨ Key Features

- **Inventory Management (CRUD):** Create, read, update product prices, and automatically deduct remaining stock in decimal kilograms (`0.1 kg` precision).
- **Order & Revenue Analytics:** Record sales transactions, separate **Cash** and **Bank Transfer (QR)** revenues, and filter daily financial reports by date (`?date=YYYY-MM-DD`).
- **Automated SePay Bank Webhook:** Receive real-time incoming bank balance notifications, log transaction histories into `bank_transactions`, and provide a payment status polling endpoint.
- **Token-Based Authentication:** Secure admin routes using **Laravel Sanctum** `Bearer Tokens`.
- **Text-to-Speech (TTS) Audio Proxy:** Provide an intermediary endpoint to stream Vietnamese voice notifications reliably across mobile browsers.

---

## 🗄️ Database Schema

1. `products`: Stores fruit names, unit prices per kg, and real-time `stock` quantities.
2. `orders`: Stores total amounts, split payment details (`cash_amount`, `transfer_amount`), and itemized summaries.
3. `bank_transactions`: Logs incoming bank transfers received from SePay webhooks.
4. `users` & `personal_access_tokens`: Manages administrator credentials and active Sanctum API tokens.

---

## 🚀 Local Setup & Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/hqvicntt/fruit-shop-backend
    cd fruit-shop-backend
    ```
2. **Install PHP dependencies:**
    ```bash
    composer install
    ```
3. **Configure environment variables:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    _(Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in your `.env` file)._
4. **Run database migrations and start the development server:**
    ```bash
    php artisan migrate
    php artisan serve --host=0.0.0.0 --port=8000
    ```

---

## 👨‍💻 Author

- **Huynh Quang Vi** – Information Technology Student, Can Tho University (CTU).

---
