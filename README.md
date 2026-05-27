# BlogYaari — Blog Management System

A full-stack blog management system built with Laravel 11, featuring a modern public-facing blog with live AJAX filtering and a polished admin panel for complete content management.

**Live URL:** _https://your-app.onrender.com_ (update after deployment)

---

## Features

### Public Site
- Responsive blog listing with card grid layout
- Live AJAX filtering by category, date, and keyword search (no page reload)
- Full blog detail page with hero image and article view
- Paginated results

### Admin Panel (`/admin`)
- Secure login with session authentication
- Dashboard with total blogs & categories stats, recent blogs list
- Full blog CRUD — create, edit, delete with image upload via UploadThing
- Category management — add and delete categories
- Protected by middleware (unauthenticated users redirected to login)

---

## Tech Stack

| Layer       | Technology                          |
|-------------|-------------------------------------|
| Backend     | Laravel 11 (PHP 8.3+)               |
| Database    | MySQL (Aiven Cloud)                 |
| Frontend    | Bootstrap 5 + Bootstrap Icons       |
| Fonts       | Inter (Google Fonts)                |
| JavaScript  | jQuery + AJAX                       |
| Images      | UploadThing (cloud) / local storage |
| Deployment  | Render (app) + Aiven (MySQL)        |

---

## Local Setup

### Prerequisites
- PHP 8.3+
- Composer
- MySQL database (local or cloud)

### Steps

```bash
# 1. Clone the repository
git clone https://github.com/your-username/blog-management-system.git
cd blog-management-system

# 2. Install dependencies
composer install

# 3. Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# 4. Configure your .env
#    Fill in DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
#    For Aiven: also set MYSQL_ATTR_SSL_CA to path of your ca.pem
#    For image uploads: fill UPLOADTHING_SECRET and UPLOADTHING_APP_ID

# 5. Run migrations and seed sample data
php artisan migrate --seed

# 6. Link storage (for local image fallback)
php artisan storage:link

# 7. Start the development server
php artisan serve
```

Visit `http://localhost:8000` for the public site.
Admin panel: `http://localhost:8000/admin`

---

## Admin Credentials

| Field    | Value                 |
|----------|-----------------------|
| Email    | admin@blogyaari.com   |
| Password | admin@123             |

---

## Environment Variables

| Variable              | Description                                  |
|-----------------------|----------------------------------------------|
| `DB_HOST`             | MySQL host (Aiven endpoint)                  |
| `DB_PORT`             | MySQL port                                   |
| `DB_DATABASE`         | Database name                                |
| `DB_USERNAME`         | MySQL username                               |
| `DB_PASSWORD`         | MySQL password                               |
| `MYSQL_ATTR_SSL_CA`   | Path to Aiven SSL CA certificate             |
| `UPLOADTHING_SECRET`  | UploadThing API secret key                   |
| `UPLOADTHING_APP_ID`  | UploadThing App ID                           |
| `APP_KEY`             | Laravel application key (auto-generated)     |
| `APP_URL`             | Full URL of the deployed app                 |

---

## Deployment (Render + Aiven)

### Database (Aiven)
1. Create a free MySQL cluster at [aiven.io](https://aiven.io)
2. Download the CA certificate and note the connection details

### App (Render)
1. Push this repo to GitHub
2. Create a new **Web Service** on [render.com](https://render.com)
3. Connect your GitHub repository
4. Set **Environment** to `Docker`
5. Add all required environment variables in the Render dashboard
6. Deploy — Render will build the Docker image and run migrations automatically

The `render.yaml` and `Dockerfile` in this repo handle the full build and deployment process.

---

## Project Structure

```
app/
  Http/Controllers/
    BlogController.php              ← Public blog listing & detail
    Admin/AuthController.php        ← Admin login/logout
    Admin/BlogController.php        ← Admin blog CRUD
    Admin/CategoryController.php    ← Admin category management
  Http/Middleware/
    AdminMiddleware.php
  Models/
    Blog.php
    Category.php
  Services/
    UploadThingService.php          ← Cloud image upload
resources/views/
  layouts/
    app.blade.php                   ← Public layout
    admin.blade.php                 ← Admin layout
  blogs/
    index.blade.php                 ← Public blog listing
    show.blade.php                  ← Blog detail page
    partials/card-grid.blade.php    ← AJAX-loaded card grid
  admin/
    login.blade.php
    dashboard.blade.php
    blogs/                          ← Blog CRUD views
    categories/                     ← Category management view
public/js/
  filter.js                         ← AJAX filtering logic
```
