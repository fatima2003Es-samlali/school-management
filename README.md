# school-management

School Management is a simple Laravel CRUD application for managing a school. It includes authentication, role-based dashboards, classes, teachers, students, books, and assignments/devoirs.

The project uses MVC architecture:

- Models in `app/Models`
- Controllers in `app/Http/Controllers`
- Blade views in `resources/views`

The UI uses Bootstrap with a responsive blue theme. Desktop users get a full sidebar, tablet users get a compact navigation rail, and mobile users get an offcanvas menu.

## Requirements

- PHP 8.2 or higher
- Composer
- Laravel 8 or higher. This project currently uses Laravel 12.
- SQLite, MySQL, or another database supported by Laravel

## Installation

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies if you want to use the Vite build tools:

```bash
npm install
```

## Environment Setup

Copy the example environment file:

```bash
copy .env.example .env
```

On macOS/Linux, use:

```bash
cp .env.example .env
```

Configure your database in `.env`.

For SQLite, create the database file:

```bash
type nul > database/database.sqlite
```

Then set:

```env
DB_CONNECTION=sqlite
```

For MySQL, set your database name, username, and password:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_management
DB_USERNAME=root
DB_PASSWORD=
```

Generate the application key:

```bash
php artisan key:generate
```

## Database

Run migrations and seeders:

```bash
php artisan migrate:fresh --seed
```

This creates the tables and default test accounts.

## Start the Server

```bash
php artisan serve
```

Open:

```text
http://127.0.0.1:8000
```

## Demo Accounts

- Admin: `admin@example.com` / `password`
- Teacher: `teacher@example.com` / `password`
- Student: `student@example.com` / `password`

## Main Features

Admin:

- Dashboard
- Classes CRUD
- Teachers CRUD
- Students CRUD
- Books CRUD

Teacher:

- View students by class
- Assignments/devoirs CRUD
- Books read-only

Student:

- View assignments/devoirs for their class
- Books read-only

## Useful Commands

Show routes:

```bash
php artisan route:list
```

Run tests:

```bash
php artisan test
```
