# 🚀 Laravel Blade App with Vite, Tailwind, and SQLite

This project is a Laravel Blade application that uses Vite, Tailwind CSS, and Alpine.js for a modern frontend stack. It uses SQLite for simple local development.

---

## 🛠 Requirements

Before you begin, make sure you have these installed:

* PHP >= 8.1
* Composer
* Node.js >= 18
* npm

## 🧰 Installation Steps

Clone the repository and install dependencies:
```
git clone git@github.com:Fadhyoung/elitech-instalite.git
cd your-repo
composer install
npm install

```

## ⚙️ Set Up Environment

Copy the example .env file and generate the app key:
```
cp .env.example .env
php artisan key:generate
```

## 🗃️ Run Migrations and Seeders

To set up your tables and seed the database:
```
php artisan migrate:fresh --seed
```

## 🔥 Run the App
Use the following command to start the backend server and frontend assets in parallel:
```
npm run dev
php artisan serve
```
SQLite (optional, but preferred for running without MySQL)

## 📁 Project Structure Highlights

* Blade templates in resources/views
* TailwindCSS and Alpine.js via Vite
* SQLite database for local use (file: database/database.sqlite)
* Factories and seeders available to generate test data

## Folder Structure
```
├── app
├── artisan
├── bootstrap
├── composer.json
├── composer.lock
├── config
├── database
├── node_modules
├── package.json
├── package-lock.json
├── phpunit.xml
├── postcss.config.js
├── public
├── README.md
├── resources
├── routes
├── storage
├── tailwind.config.js
├── tests
├── vendor
└── vite.config.js

```
