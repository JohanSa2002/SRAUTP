# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

**UTP Académico** — A platform for managing scientific research articles and events for Universidad Tecnológica de Panamá. Built with Laravel 12, Blade templates, Tailwind CSS, Alpine.js, and SQLite.

## Common Commands

### Development (local, non-Docker)
```bash
composer setup        # Full initial setup: install deps, generate key, migrate, build assets
composer dev          # Start dev servers concurrently (artisan serve, queue, logs, vite)
composer test         # Run tests
npm run dev           # Vite dev server only
npm run build         # Build production assets
```

### Docker (primary deployment method)
```bash
docker-compose up -d --build          # Build and start all services
docker-compose exec app php artisan   # Run any Artisan command
docker-compose logs -f app            # Stream application logs
docker-compose down                   # Stop containers
```
Access the app at http://localhost:8080 after Docker startup. Migrations, storage link, and config caching happen automatically via `docker/entrypoint.sh`.

### Common Artisan Commands
```bash
php artisan migrate
php artisan tinker
php artisan storage:link
```

## Architecture

### User Roles
Three roles distinguished by boolean flags on the `users` table:
- **Student** (default): Can submit articles, view their own, browse events/library
- **Advisor** (`is_advisor=true`): Can evaluate articles assigned to them
- **Admin** (`is_admin=true`): Full access; guarded by `AdminMiddleware` on all `/admin/*` routes

### Article Workflow
`revisión` → Advisor evaluates → `aprobado` or `rechazado`

Students submit articles selecting an advisor and event. Advisors change status. Admins can override everything.

### Routes Structure ([routes/web.php](routes/web.php))
- `/` — Public landing page
- `/dashboard` — Authenticated dashboard
- `/articles` — Resource routes; controller returns different data per role
- `/events` — Resource routes; admin sub-routes for mutations
- `/library` — Browse/upload shared documents (admin uploads, all users read)
- `/profile` — Profile CRUD + `/profile/search` and `/profile/view/{id}` for public profiles
- `/admin/users`, `/admin/articles`, `/admin/notices` — Admin-only routes

### Controllers
| Controller | Purpose |
|-----------|---------|
| `ArticleController` | Article CRUD, file upload, advisor evaluation |
| `AdminController` | User list, global article search, user deletion |
| `EventController` | Event CRUD with image upload and JSON categories |
| `NoticeController` | News/announcements management |
| `LibraryController` | Shared document library |
| `PublicProfileController` | Search users by email, view their approved articles |
| `ProfileController` | Personal profile edit/delete |

### Models
- **User** — `cedula`, `institutional_email`, `is_advisor`, `is_admin`; has many articles as student and as advisor
- **Article** — `status` enum (`aprobado`/`revisión`/`rechazado`), belongs to Event, student User, advisor User
- **Event** — `categories` stored as JSON array, `is_active` boolean
- **Notice** — Announcements with category and `is_active` flag
- **LibraryResource** — Files categorized as `plantilla`, `guía`, `reglamento`, `otro`

### Frontend
- **Tailwind CSS** with custom cyber-purple color palette (glassmorphism design system)
- **Alpine.js** for interactive UI components
- **Vite** for asset bundling
- Views in `resources/views/` organized by module: `admin/`, `articles/`, `events/`, `library/`, `profile/`, `auth/`, `components/`, `layouts/`

### Database
SQLite (`database/database.sqlite`). In Docker, persisted via `sqlite_data` volume. Uploaded files persisted via `storage_data` volume.

### Authentication
Laravel Breeze (session-based). Routes in `routes/auth.php`. Email verification is optional (commented out in User model).
