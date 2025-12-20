# Restaurant Website

A responsive restaurant website built with Laravel, featuring modern design, interactive menu system, and table reservation management.

## Project Structure
```
Restaurant-Menu/
├── app/
│   ├── Filament/
│   │   ├── Resources/        # Filament admin panel resources
│   │   └── Widgets/          # Admin dashboard widgets
│   ├── Http/
│   │   └── Controllers/      # Application controllers
│   │       ├── BookingController.php
│   │       ├── PageController.php
│   │       └── ReservationManageController.php
│   ├── Mail/                 # Email notification classes
│   │   ├── ReservationAccepted.php
│   │   ├── ReservationConfirmation.php
│   │   └── ReservationRejected.php
│   ├── Models/               # Eloquent models
│   │   ├── Category.php
│   │   ├── MenuItem.php
│   │   ├── Reservation.php
│   │   └── User.php
│   └── Providers/
├── assets/                   # Frontend assets (source)
│   ├── css/
│   │   └── style.css
│   ├── images/               # Restaurant images
│   ├── js/
│   │   ├── main.js
│   │   └── menu.js
│   └── videos/
│       └── promo.mp4
├── database/
│   ├── migrations/           # Database migrations
│   └── seeders/             # Database seeders
├── public/                   # Public assets (served by web server)
│   └── assets/              # Symlinked/copied from assets/
├── resources/
│   └── views/               # Blade templates
│       ├── about.blade.php
│       ├── booking.blade.php
│       ├── contacts.blade.php
│       ├── index.blade.php
│       ├── menu.blade.php
│       ├── reservation-manage.blade.php
│       ├── components/      # Reusable Blade components
│       │   ├── footer.blade.php
│       │   ├── header.blade.php
│       │   └── topbar.blade.php
│       └── emails/          # Email templates
│           ├── reservation-accepted.blade.php
│           ├── reservation-confirmation.blade.php
│           └── reservation-rejected.blade.php
├── routes/
│   └── web.php              # Web routes
├── composer.json
└── README.md
```

## Pages
- **Home** (`/`) - Hero section, menu categories, about us, events, reviews
- **Menu** (`/menu`) - Filterable food items by category with dynamic loading
- **About** (`/about`) - Restaurant story, features, statistics, testimonials
- **Booking** (`/booking`) - Table reservation form with validation
- **Contact** (`/contacts`) - Contact form
- **Reservation Management** (`/reservation/{code}`) - Public reservation management page

## Features
- **Responsive Design** - Mobile-first, modern UI
- **Menu Management** - Dynamic menu items with categories
- **Table Reservations** - Online booking system with email confirmations
- **Reservation Management** - Customers can view, update, or cancel reservations using unique codes
- **Admin Dashboard** - Filament admin panel for managing menu items, categories, and reservations
- **Email Notifications** - Automated emails for reservation confirmations, acceptances, and rejections
- **QR Code Generation** - QR codes for reservations
- **Media Library** - Image upload and management for menu items
- **Component-Based Structure** - Reusable Blade components (header, footer, topbar)
- **Modern UI** - Google Fonts & Font Awesome icons

## Tech Stack
- **Backend**: Laravel 12, PHP 8.2+
- **Admin Panel**: Filament 3.2
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Libraries**:
  - Spatie Media Library (image management)
  - Simple QR Code (QR code generation)
- **UI**: Google Fonts, Font Awesome

## Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Database (MySQL)

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Restaurant-Menu
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   - Edit `.env` file with your database credentials
   - Run migrations:
     ```bash
     php artisan migrate
     ```

5. **Create admin user** (optional)
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   ```

6. **Link storage** (for media uploads)
   ```bash
   php artisan storage:link
   ```

7. **Start development server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   - Frontend: http://localhost:8000
   - Admin Panel: http://localhost:8000/admin

## Configuration

### Email Settings
Configure your email settings in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=noreply@restaurant.com
MAIL_FROM_NAME="${APP_NAME}"
```

### File Storage
The application uses Laravel's filesystem. Configure in `.env`:
```env
FILESYSTEM_DISK=public
```

## Admin Panel

Access the Filament admin panel at `/admin` to:
- Manage menu items and categories
- View and manage reservations
- Accept or reject reservations
- Upload menu item images
- View statistics and reports

## Routes

### Public Routes
- `GET /` - Home page
- `GET /menu` - Menu page
- `GET /about` - About page
- `GET /booking` - Booking form
- `GET /contacts` - Contact page
- `POST /booking` - Submit reservation
- `GET /reservation/{code}` - View reservation
- `POST /reservation/{code}/update` - Update reservation
- `POST /reservation/{code}/cancel` - Cancel reservation

### Admin Routes
- `/admin` - Filament admin dashboard

## Database Schema

### Tables
- `users` - Admin users
- `categories` - Menu categories
- `menu_items` - Menu items with category relationships
- `reservations` - Table reservations
- `media` - Media library for images

