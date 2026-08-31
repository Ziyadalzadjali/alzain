# Al Zain — Phase 1 Setup (run these yourself)

Run these in the **Laragon terminal** (Menu → Terminal, or the "Terminal" button).
They install the Laravel base. After this, I can write the custom code into the folder.

## 0. Prerequisites (Laragon already has these)
- PHP 8.2+  ·  Composer  ·  MySQL running  ·  Node.js + npm

Check:
```
php -v
composer --version
node -v
```

## 1. Create the Laravel project
The `alzain` folder isn't empty (it has WORKFLOW.md), and `create-project` needs
an empty folder, so move the docs out first, install, then move them back:

```
cd D:\laragon\www
move alzain\WORKFLOW.md WORKFLOW.md.bak
move alzain\SETUP-PHASE1.md SETUP-PHASE1.md.bak
rmdir alzain
composer create-project laravel/laravel alzain
move WORKFLOW.md.bak alzain\WORKFLOW.md
move SETUP-PHASE1.md.bak alzain\SETUP-PHASE1.md
cd alzain
```

Laragon auto-creates the domain: your site is now at **http://alzain.test**

## 2. Database
In Laragon, open **HeidiSQL** (or Menu → MySQL) and create a database named `alzain`.
Then edit `.env`:
```
DB_DATABASE=alzain
DB_USERNAME=root
DB_PASSWORD=
APP_TIMEZONE=Asia/Muscat
APP_URL=http://alzain.test
```
Then:
```
php artisan migrate
```

## 3. Tailwind CSS
```
npm install
npm install -D tailwindcss @tailwindcss/vite
```
(For Laravel 11 + Vite, the Tailwind v4 plugin is simplest. I'll wire the config +
RTL direction when I write the custom files.)

## 4. Admin panel — Filament
```
composer require filament/filament
php artisan filament:install --panels
php artisan make:filament-user
```
Admin panel will be at **http://alzain.test/admin**

## 5. Customer auth — Breeze
```
composer require laravel/breeze --dev
php artisan breeze:install blade
npm run build
```

## 6. Roles & permissions
```
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

## 7. Localization (Arabic + English, RTL)
```
composer require mcamara/laravel-localization
composer require spatie/laravel-translatable
php artisan vendor:publish --provider="Mcamara\LaravelLocalization\LaravelLocalizationServiceProvider"
```

## When these finish
Tell me they're done (and if the Linux shell is back, even better). Then I'll write:
- `config/laravellocalization.php` set to `ar` + `en`
- a language switcher + RTL `dir="rtl"` in the layout
- the first migrations & models: Branch, ServiceCategory, Service, Staff, Product, Category
- a seeder with sample bilingual data

so you finish Phase 1 with a running, bilingual skeleton.
