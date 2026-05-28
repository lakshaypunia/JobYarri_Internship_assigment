# BlogYaari — Blog Management System

A full-stack blog management system built with Laravel 11, featuring a modern public-facing blog with live AJAX filtering and a polished admin panel for complete content management.

---

## Links

| | URL |
|---|---|
| **Live Site** | https://jobyarri-internship-assigment.onrender.com |
| **Admin Panel** | https://jobyarri-internship-assigment.onrender.com/admin |

## Admin Login

| Field    | Value               |
|----------|---------------------|
| Email    | admin@blogyaari.com |
| Password | admin@123           |

---

## Features

### Public Site
- Responsive blog listing with card grid layout
- Live AJAX filtering by category, date, and keyword search (no page reload)
- Blog detail page with hero image, rich HTML content rendering
- Paginated results

### Admin Panel
- Secure login with session authentication
- Dashboard with stats (total blogs, categories, blogs this month)
- Full blog CRUD — create, edit, delete
- Rich text editor (Jodit) — bold, italic, headings, tables, lists, links, image upload
- Image upload via Cloudinary (persistent cloud storage)
- Category management — add and delete categories
- Protected by middleware (unauthenticated users redirected to login)

---

## Tech Stack

| Layer      | Technology                    |
|------------|-------------------------------|
| Backend    | Laravel 11 (PHP 8.4)          |
| Database   | MySQL (Aiven Cloud)           |
| Frontend   | Bootstrap 5 + Bootstrap Icons |
| Fonts      | Inter (Google Fonts)          |
| JavaScript | jQuery + AJAX                 |
| Editor     | Jodit Rich Text Editor v3     |
| Images     | Cloudinary (cloud CDN)        |
| Deployment | Render (Docker) + Aiven MySQL |

---

## Local Setup

### Prerequisites
- PHP 8.4+
- Composer
- MySQL database (local or Aiven cloud)

### Steps

```bash
# 1. Clone the repository
git clone <your-github-repo-url>
cd blog-management-system

# 2. Install PHP dependencies
composer install

# 3. Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# 4. Fill in your .env (see Environment Variables section below)

# 5. Run migrations and seed sample data
php artisan migrate --seed

# 6. Create storage symlink for local image serving
php artisan storage:link

# 7. Start the development server
php artisan serve
```

Visit `http://localhost:8000` — public site.
Visit `http://localhost:8000/admin` — admin panel.

---

## Environment Variables

Copy `.env.example` to `.env` and fill in the following:

```env
# App
APP_KEY=           # Run: php artisan key:generate
APP_URL=http://localhost:8000

# Database (Aiven MySQL)
DB_HOST=your-mysql-host.aivencloud.com
DB_PORT=12302
DB_DATABASE=defaultdb
DB_USERNAME=avnadmin
DB_PASSWORD=your-password
MYSQL_ATTR_SSL_CA=/absolute/path/to/storage/app/ca.pem

# Image uploads (Cloudinary)
CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
```

**Getting credentials:**
- **Aiven MySQL** — [aiven.io](https://aiven.io) free tier, download the CA cert to `storage/app/ca.pem`
- **Cloudinary** — [cloudinary.com](https://cloudinary.com) free tier, copy Cloud Name / API Key / API Secret from dashboard

---

## Deployment (Render + Aiven)

This repo includes `Dockerfile`, `docker-entrypoint.sh`, and `render.yaml` for one-click deployment.

### Steps
1. Push this repo to GitHub
2. Go to [render.com](https://render.com) → **New Web Service** → connect your GitHub repo
3. Set environment to `Docker`
4. Add environment variables in the Render dashboard:
   - `APP_KEY` — run `php artisan key:generate --show` locally and paste the result
   - `APP_URL` — your Render URL (e.g. `https://your-app.onrender.com`)
   - All `DB_*` variables from your Aiven cluster
   - `MYSQL_ATTR_SSL_CA` — `/var/www/html/storage/app/ca.pem`
   - `CLOUDINARY_*` variables
5. Add your Aiven `ca.pem` as a **Secret File** at path `/var/www/html/storage/app/ca.pem`
6. Deploy — Render builds the Docker image and runs migrations automatically

---

## Project Structure

```
app/
  Http/Controllers/
    BlogController.php              ← Public blog listing, detail, AJAX filter
    Admin/AuthController.php        ← Admin login / logout
    Admin/BlogController.php        ← Admin blog CRUD + image upload endpoint
    Admin/CategoryController.php    ← Category management
  Http/Middleware/
    AdminMiddleware.php             ← Protects all /admin routes
  Models/
    Blog.php                        ← image_url accessor (Cloudinary + local)
    Category.php
  Services/
    CloudinaryService.php           ← Signed image upload to Cloudinary
resources/views/
  layouts/
    app.blade.php                   ← Public layout (sticky navbar, footer)
    admin.blade.php                 ← Admin layout (sidebar, topbar)
  blogs/
    index.blade.php                 ← Public blog listing with filter bar
    show.blade.php                  ← Blog detail page
    partials/card-grid.blade.php    ← AJAX-swapped card grid
  admin/
    login.blade.php
    dashboard.blade.php
    blogs/create.blade.php          ← Jodit rich text editor
    blogs/edit.blade.php            ← Jodit rich text editor
    categories/index.blade.php
  vendor/pagination/
    bootstrap-5.blade.php           ← Custom pagination (no oversized arrows)
public/js/
  filter.js                         ← jQuery AJAX filter (category + date + search)
database/
  seeders/
    AdminSeeder.php                 ← admin@blogyaari.com / admin@123
    CategorySeeder.php              ← 4 categories
    BlogSeeder.php                  ← 12 sample blogs
```
