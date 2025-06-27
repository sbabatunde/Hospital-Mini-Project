# 🏥 HospitalMini – Smart Healthcare Platform

**HospitalMini** is a Laravel-based healthcare management platform that allows **doctors** and **clients** to interact efficiently through scheduling, medical history tracking, secure messaging, appraisals, and ratings.

## 🚀 Features

- User registration with roles: Admin, Doctor, Client
- Doctor profile with specialization, license, bio
- Appointment scheduling with rescheduling support
- Medical history management (diagnosis, medications, attachments)
- Secure internal messaging (Laravel Notifications)
- Rating and review system (1 to 5 stars)
- Doctor appraisal by Admin
- Admin dashboard with:
  - All clients & doctors
  - Mail/Notification center
  - View schedules & ratings
- Responsive and elegant UI (TailwindCSS)

---

## 🛠️ Installation

### Requirements

- PHP 8.1+
- Composer
- MySQL or compatible DB
- Node.js & npm (for frontend assets)
- Laravel 10+
- Git

### Setup

```bash
# Clone the repository
git clone https://github.com/yourusername/miniHospital.git
cd miniHospital

# Install PHP dependencies
composer install

# Install Node packages (for Tailwind, Alpine.js, etc.)
npm install && npm run dev

# Copy .env and configure
cp .env.example .env
php artisan key:generate

# Set your database credentials in .env

# Run migrations and seed default data
php artisan migrate --seed

# Link storage for uploads
php artisan storage:link

# Start local development server
php artisan serve
