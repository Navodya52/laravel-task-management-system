# Task Management System

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue?style=for-the-badge)

[![Laravel Automated Tests](https://github.com/Navodya52/laravel-task-management-system/actions/workflows/tests.yml/badge.svg)](https://github.com/Navodya52/laravel-task-management-system/actions/workflows/tests.yml)

A responsive and user-friendly Task Management System built with Laravel. This application helps users organize their daily activities, manage tasks, track progress, and categorize work through a clean and intuitive interface.

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Screenshots](#screenshots)
- [Technology Stack](#technology-stack)
- [System Requirements](#system-requirements)
- [Installation and Setup](#installation-and-setup)
- [Database Configuration](#database-configuration)
- [Running the Application](#running-the-application)
- [Automated Testing](#automated-testing)
- [Project Structure](#project-structure)
- [Future Improvements](#future-improvements)
- [Author](#author)

## Overview

The Task Management System is a web application designed to simplify personal task organization and productivity tracking.

Users can create and manage tasks, assign categories, update task details, mark tasks as completed, and monitor their progress through a dashboard. Authentication and user-specific task access help ensure that users manage their own tasks securely.

The project was developed to practice Laravel web development, database integration, authentication, CRUD operations, responsive UI design, automated testing, and continuous integration using GitHub Actions.

## Features

### Task Management
- Create new tasks.
- View and manage existing tasks.
- Edit task details.
- Delete tasks.
- Mark tasks as completed.
- Organize tasks by priority and status.
- Assign categories to tasks.

### Category Management
- Create custom categories.
- View available categories.
- Edit category details.
- Delete categories.

### Search, Filtering and Sorting
- Search tasks using the available search functionality.
- Filter tasks by status.
- Filter tasks by priority.
- Filter tasks by category.
- Sort tasks using the available sorting options.
- Navigate through task lists using pagination.

### Dashboard and Productivity
- View tasks in a centralized dashboard.
- Monitor task completion progress.
- View a progress bar to track productivity.
- Quickly access task management features.

### Authentication and Security
- User registration and login.
- Secure logout functionality.
- Password reset and password update functionality.
- Profile management.
- User-specific task access.
- Authentication-protected task and category routes.

### User Interface
- Responsive design for desktop and mobile screens.
- Dark mode and light mode.
- Persistent theme preference using browser local storage.
- Clean layout with a purple and pink gradient theme.
- Interactive task management controls.

### Automated Testing and CI
- Feature tests for task management.
- Tests for guest access restrictions.
- Tests for authenticated dashboard access.
- Tests for task creation.
- Tests verifying that users can only access their own tasks.
- Automated test execution using GitHub Actions.
- Workflow triggered by pushes and pull requests targeting the `main` branch.


## Screenshots

### Light Mode

The application dashboard in light mode.

![Task Management Dashboard - Light Mode](screenshots/light_mode.png)

### Dark Mode

The application dashboard in dark mode.

![Task Management Dashboard - Dark Mode](screenshots/dark_mode.png)

### Category Management

Manage task categories through the category management interface.

![Category Management](screenshots/manage_categories.png)


## Technology Stack

| Technology | Purpose |
|---|---|
| PHP 8.2 | Backend programming language |
| Laravel 12 | Backend framework |
| MySQL / MariaDB | Application database for local development |
| SQLite | Lightweight database used in automated tests |
| Blade | Server-side templating |
| HTML5 | Page structure |
| CSS3 | Styling and responsive layouts |
| JavaScript | Client-side interactions |
| Node.js and npm | Frontend dependency management and asset building |
| Composer | PHP dependency management |
| PHPUnit / Pest | Automated testing |
| Git and GitHub | Version control and source code hosting |
| GitHub Actions | Continuous integration and automated testing |
| XAMPP | Local development environment |

## System Requirements

Before installing the project, make sure you have the following tools:

- PHP 8.2 or a compatible version.
- Composer.
- Node.js and npm.
- MySQL or MariaDB, or another database supported by your Laravel configuration.
- Git.
- XAMPP or another local PHP development environment.

## Installation and Setup

Follow these steps to run the application on your local machine.

### 1. Clone the Repository

Open a terminal and run:

```bash
git clone https://github.com/Navodya52/laravel-task-management-system.git
```

Navigate into the project directory:

```bash
cd laravel-task-management-system
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Configure the Environment

Create your local environment file:

**Windows Command Prompt:**

```bash
copy .env.example .env
```

**macOS / Linux / Git Bash:**

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Install Frontend Dependencies

```bash
npm install
```

### 5. Configure the Database

Create a database for the application in MySQL or phpMyAdmin. For example:

```sql
CREATE DATABASE task_management;
```

Update the database settings in your `.env` file to match your local MySQL configuration.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=
```

> Update the database username and password according to your own environment. The example above assumes a local MySQL setup with the `root` user and an empty password.

### 6. Run Database Migrations

```bash
php artisan migrate
```

This creates the database tables defined by the project's migrations.

### 7. Build Frontend Assets

To build the frontend assets:

```bash
npm run build
```

During development, you can instead run:

```bash
npm run dev
```

Keep the development server running in its terminal while working on the frontend.

## Running the Application

Start the Laravel development server:

```bash
php artisan serve
```

Open the following URL in your browser:

**http://127.0.0.1:8000**

Register a user account or log in to access the application's task management features.

## Automated Testing

The project includes automated tests to verify important application functionality.

### Run the Tests Locally

```bash
php artisan test
```

To run only the task management feature tests:

```bash
php artisan test --filter=TaskManagementTest
```

The task management test suite covers:

- Guests are redirected to the login page when accessing the task dashboard.
- Authenticated users can access the task dashboard.
- Authenticated users can create tasks.
- Users can only see their own tasks.

### Continuous Integration with GitHub Actions

The repository includes a GitHub Actions workflow located at:

```text
.github/workflows/tests.yml
```

The workflow automatically:

1. Checks out the repository.
2. Sets up PHP and Node.js.
3. Installs Composer dependencies.
4. Prepares the Laravel environment.
5. Installs frontend dependencies.
6. Builds frontend assets.
7. Runs database migrations.
8. Executes the automated test suite.

The workflow runs when changes are pushed to `main` or when a pull request targets `main`.

Check the [Actions tab](https://github.com/Navodya52/laravel-task-management-system/actions) to view workflow results.

## Project Structure

The main application directories are organized as follows:

```text
laravel-task-management-system/
├── app/
│   └── Http/
│       └── Controllers/
│           ├── Auth/
│           ├── TaskController.php
│           ├── CategoryController.php
│           └── ProfileController.php
├── database/
│   ├── migrations/
│   └── factories/
├── public/
├── resources/
│   └── views/
│       ├── tasks/
│       ├── categories/
│       ├── layouts/
│       └── profile/
├── routes/
│   ├── web.php
│   └── auth.php
├── screenshots/
├── tests/
│   ├── Feature/
│   │   ├── Auth/
│   │   ├── ProfileTest.php
│   │   └── TaskManagementTest.php
│   └── Unit/
├── .github/
│   └── workflows/
│       └── tests.yml
├── .env.example
├── composer.json
├── package.json
└── README.md
```

*This structure highlights the main application files; some generated or additional files may not be shown.*

## Future Improvements

Potential enhancements for future versions include:

- Task due dates and deadline reminders.
- Calendar-based task views.
- Task labels and advanced filtering.
- Task statistics and productivity charts.
- Email or in-app notifications.
- Improved accessibility and interface customization.
- Additional automated tests for task updates, deletion, and category management.

## Author

**Nishadi Wickramaarachchi**

Bachelor of Computing (Honours) in Software Engineering  
Faculty of Computing, University of Sri Jayewardenepura, Sri Lanka

- GitHub: [@Navodya52](https://github.com/Navodya52)
- Project Repository: [Laravel Task Management System](https://github.com/Navodya52/laravel-task-management-system)

---

If you find this project useful, consider giving the repository a ⭐ on GitHub!
