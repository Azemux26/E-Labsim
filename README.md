
# E-Labsim — Laboratory & Simulator Scheduling Management System

> Web-based scheduling and reporting system built to digitize laboratory and simulator operations at Politeknik Maritim AMI Makassar.

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![Livewire](https://img.shields.io/badge/Livewire-3-purple)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-v4-06b6d4)
![MySQL](https://img.shields.io/badge/Database-MySQL-informational)
![Vite](https://img.shields.io/badge/Vite-7-646cff)

---

## Overview

E-Labsim is a web application designed to manage laboratory and simulator scheduling more efficiently through a centralized digital workflow.

The system was built to replace manual scheduling processes that are difficult to track and highly prone to conflicts. It provides structured scheduling, conflict detection, reporting, notifications, and multi-role access for different types of users.

This project was developed as part of an academic/research case study at **Politeknik Maritim AMI Makassar**.

---

## The Problem

Manual scheduling usually creates several operational issues:

- double-booked rooms and time slots
- instructor and resource conflicts
- difficult tracking of schedule requests and approvals
- limited visibility for students, operators, and instructors
- reporting that takes too much manual work
- scattered operational data with low traceability

A digital scheduling system was needed to make the process more reliable, organized, and easier to monitor.

---

## The Solution

E-Labsim solves this by providing:

- **centralized scheduling management**
- **real-time conflict detection** for room, time, and instructor collisions
- **multi-role authentication and access control**
- **operational reporting** in table and chart formats
- **PDF and Excel export**
- **in-app notifications** for schedule reminders and approval status
- **modern Laravel + Livewire architecture** for a more reactive user experience

This makes the scheduling workflow more structured and significantly easier to manage.

---

## Key Features

### Scheduling
- create, edit, and manage laboratory and simulator schedules
- organize schedule requests through a centralized system
- reduce manual coordination overhead

### Conflict Detection
- automatically detect schedule collisions
- validate overlapping room, time, and instructor assignments
- help prevent operational mistakes before approval

### Reporting
- generate usage reports in table and chart formats
- export reports to **PDF** and **Excel**
- support administrative recap and monitoring

### Authentication & Roles
- multi-role login system
- role-based access for:
  - Admin
  - Operator
  - Lecturer / Instructor
  - Student

### Notifications
- in-app notifications for:
  - schedule reminders
  - approval status updates
  - workflow-related updates

---

## Preview

> This repository focuses on the technical implementation and setup.  
> A full visual walkthrough and case study are available in my portfolio.

### Option A — GIF Preview
![E-Labsim Demo](docs/demo/e-labsim-preview.gif)

### Option B — Main Screenshot
<!-- ![E-Labsim Preview](docs/screenshots/e-labsim-preview-main.png) -->

### Portfolio & Contact
- **Portfolio:** https://your-portfolio-link.com
- **Contact:** your-email@example.com
- **Project walkthrough / collaboration:** available on request

---

## Technical Highlights

This project demonstrates more than standard CRUD development. It includes:

- **real-time operational validation**
  - schedule conflict detection across multiple dimensions
- **reactive full-stack UI**
  - built using Laravel + Livewire
- **report generation**
  - export to PDF and Excel
- **multi-role workflow**
  - different interfaces and actions for different user types
- **notification-ready architecture**
  - supports scheduling and approval communication
- **production-oriented setup**
  - authentication, queue support, testing, file storage, and environment configuration

---

## Workflow

### Basic Scheduling Flow
1. User logs into the system based on role
2. A schedule request or schedule entry is created
3. The system checks for possible conflicts
4. If no conflict is detected, the schedule can proceed
5. Relevant users can review status and updates
6. Reports can be generated for recap and monitoring

### Role Perspective
- **Admin** → full access to all features and user management
- **Operator** → manage schedules and print reports
- **Lecturer / Instructor** → submit and view schedules
- **Student** → view schedule and booking status

---

## Architecture Snapshot

```bash
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Livewire/
├── Models/
├── Providers/
database/
├── migrations/
└── seeders/
resources/
├── views/
│   └── livewire/
├── css/
│   └── app.css
└── js/
    └── app.js
routes/
└── web.php
tests/
````

### Important Technical Areas

* `Livewire/` → interactive scheduling interface and reactive components
* `Http/Middleware/` → auth and role restrictions
* `database/seeders/` → default role/user initialization
* `resources/views/livewire/` → UI layer for Livewire-based pages
* `tests/` → automated testing with Pest PHP

---

## Tech Stack

| Layer                | Technology               |
| -------------------- | ------------------------ |
| Backend              | Laravel 12               |
| Language             | PHP 8.2+                 |
| Reactive UI          | Livewire 3               |
| UI Library           | Livewire Flux            |
| Component Syntax     | Livewire Volt            |
| Authentication       | Laravel Fortify          |
| Styling              | Tailwind CSS v4          |
| Build Tool           | Vite 7                   |
| JavaScript Utilities | Axios, SweetAlert2       |
| Reporting            | DomPDF                   |
| Excel Export         | Maatwebsite Excel        |
| Database             | MySQL 8+ / MariaDB 10.6+ |
| Testing              | Pest PHP                 |

---

## Why This Project Matters

This project demonstrates my ability to build:

* scheduling systems for real operational use
* conflict-aware workflows
* multi-role access control
* reporting dashboards and exports
* admin-oriented information systems
* structured internal tools for institutions or organizations

It reflects the type of application often needed by campuses, training centers, labs, internal business operations, and service organizations.

---

## System Requirements

Make sure your environment includes:

* PHP >= 8.2
* Composer >= 2.x
* Node.js >= 20.19.0 or >= 22.12.0
* NPM >= 10.x
* MySQL >= 8.0
* Git

> Important: Vite v7 and `laravel-vite-plugin` v2 require a recent Node.js version. Older Node versions may fail during install/build.

---

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/Azemux26/E-Labsim.git
cd E-Labsim
```

### 2. Create Database

```sql
CREATE DATABASE e_labsim CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 3. Copy Environment File

```bash
# Windows
copy .env.example .env

# Mac / Linux
cp .env.example .env
```

### 4. Configure `.env`

```env
APP_NAME="e-LABSIM"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_labsim
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

### 5. Install Dependencies

```bash
composer install
npm install
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Run Migration and Seeder

```bash
php artisan migrate:fresh --seed
```

> Use `migrate:fresh --seed` only for first-time setup or when you intentionally want to reset the database.

### 8. Create Storage Link

```bash
php artisan storage:link
```

### 9. Build Frontend Assets

```bash
npm run build
```

---

## Running the Project

### Development

```bash
composer run dev
```

This command runs:

* Laravel web server
* queue listener
* Vite development server

Then open:

```bash
http://127.0.0.1:8000
```

### Useful Alternatives

```bash
php artisan serve
php artisan queue:listen
npm run dev
```

---

## Seeded Roles

If you use the included seeders, the system is designed around these roles:

* **Admin**
* **Operator**
* **Lecturer / Instructor**
* **Student**

> Adjust any default credentials based on your actual `database/seeders/` files before publishing or deploying.

---

## Testing

This project uses **Pest PHP** for automated testing.

### Run all tests

```bash
composer run test
```

### Or run via artisan

```bash
php artisan test
```

### Run specific tests

```bash
php artisan test --filter=NamaTest
```

---

## Useful Commands

### Application

```bash
composer run dev
php artisan serve
```

### Database

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan migrate:rollback
php artisan db:seed
```

### Cache / Config

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

### Generate Files

```bash
php artisan make:model NamaModel -mcr
php artisan make:livewire NamaComponent
php artisan make:migration nama_tabel
```

### Debug / Info

```bash
php artisan route:list
php artisan about
composer show --installed
```

---

## Troubleshooting

### `npm install` engine / unsupported engine error

Your Node.js version is too old.

```bash
node --version
nvm install 22 && nvm use 22
npm install
```

### White page / 500 error after clone

```bash
php artisan key:generate
php artisan config:clear
php artisan migrate:fresh --seed
npm run build
```

### No CSS / broken styling

```bash
npm run build
```

Or run:

```bash
composer run dev
```

### Queue error — `jobs` table not found

```bash
php artisan queue:table
php artisan migrate
```

### Uploaded files are not accessible

```bash
php artisan storage:link
```

### Autoload / class not found error

```bash
composer dump-autoload
```

### Linux / Mac permission issue

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## Future Improvements

* calendar-style schedule visualization
* approval workflow enhancements
* email notification integration
* dashboard analytics for room utilization
* institution-wide resource management expansion
* API layer for mobile or third-party integration

---

## Author

**Rafli**
Backend Web Developer focused on Laravel-based information systems, scheduling workflows, and admin dashboards.

* GitHub: [https://github.com/Azemux26](https://github.com/Azemux26)
* Portfolio: [https://your-portfolio-link.com](https://your-portfolio-link.com)
* Email: [your-email@example.com](mailto:your-email@example.com)

---

## License

This project was developed for academic/research purposes at Politeknik Maritim AMI Makassar and is distributed under the MIT License.

```


```

[1]: https://github.com/Azemux26/E-Labsim "GitHub - Azemux26/E-Labsim · GitHub"
