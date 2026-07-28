# Project Overview: Tugas (Student & Academic Management System)

A comprehensive academic management system built with Laravel 13, focusing on student records, lecturer data, course management, and student achievements (prestasi).

## 🛠 Tech Stack
- **Backend:** PHP 8.3+, Laravel 13.0
- **Frontend:** Vite, Tailwind CSS 4.0, Bootstrap Icons
- **Database:** MySQL/SQLite (Standard Laravel support)
- **Tooling:** Composer, NPM

## 🚀 Key Commands

### Setup & Installation
```bash
# Full setup including environment, migrations, and assets
composer run setup
```

### Development
```bash
# Start all development services (Server, Queue, Vite, Logs)
composer run dev

# Or individually
php artisan serve
npm run dev
```

### Testing & Quality
```bash
# Run PHPUnit tests
composer run test

# Run Laravel Pint (Linting)
./vendor/bin/pint
```

## 🏗 Architecture & Modules

### Core Modules
- **Mahasiswa (Students):** Detailed student profiles and academic tracking.
- **Dosen (Lecturers):** Faculty member management.
- **Mata Kuliah (Courses):** Curriculum and subject management.
- **Tahun Akademik:** Academic year configurations.
- **Bimbingan:** Academic guidance/mentorship tracking.
- **Prestasi (Achievements):** Managing student competition references, registrations, and achievements.

### Authentication & Authorization
- **Auth:** Custom login and registration flows defined in `routes/web.php`.
- **RBAC:** Custom Role and Permission system managed via `RoleController`.

## 📝 Development Conventions

### Routing
- **Avoid `Route::resource` for Mahasiswa:** Use explicit custom routes to prevent naming conflicts and maintain granular control.
- **Consistent Naming:** Routes typically follow the pattern `{action}-{module}` (e.g., `create-mahasiswa`, `data-mahasiswa`).

### Views
- **Organization:** Views are strictly organized in subdirectories: `resources/views/{module}/{action}.blade.php`.
- **Layout:** All pages must extend `layout.app`.
- **Styling:** Use standard custom classes for consistency:
    - `.card-custom`: For main content containers.
    - `.title-page`: For page headings.
    - `.header-section`: For the top section containing titles and "Add" buttons.
- **Modals:** Use Bootstrap modals for sensitive actions like data deletion (confirm before delete).

### Data Management
- **Primary Keys:** Some models use non-standard primary keys (e.g., `NIM` for Mahasiswa, `NIP` for Dosen, `kode_matkul` for Mata Kuliah). Ensure controllers handle these appropriately in routes and queries.
- **Validation:** Always include `@error` blocks in forms and display session success alerts in the index/show views.

## 📁 Key Directories
- `app/Http/Controllers`: Module logic.
- `app/Models`: Database models (check for custom `$primaryKey`).
- `database/migrations`: Schema definitions.
- `resources/views`: UI templates (Blade).
- `routes/web.php`: Primary route definitions and some inline logic.
