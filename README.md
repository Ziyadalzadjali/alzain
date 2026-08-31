# Al Zain

Bilingual (Arabic RTL default / English) Laravel platform for a ladies salon and
beauty house — **salon booking** + an **online shop** for skincare, facials and
fashion.

- Laravel 13 · PHP 8.3 · SQLite (dev) · Tailwind v4 · Filament v4 admin
- `spatie/laravel-translatable` for bilingual content fields

## Run it locally (Laragon)

```bash
composer install
npm install
cp .env.example .env   # if .env is missing
php artisan key:generate
php artisan migrate:fresh --seed
npm run build
php artisan serve
```

Then open http://127.0.0.1:8000 (or the Laragon host `http://alzain.test`
once `npm run build` has produced `public/build`).

Dev with hot reload: `npm run dev` in one terminal, `php artisan serve` in another.

### Admin panel

- URL: `/admin`
- Email: `admin@alzain.test`
- Password: `password`  ← change this before any real use

Create more admins: `php artisan make:filament-user`

### Switch to MySQL

Start MySQL in Laragon, create a database `alzain`, then in `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alzain
DB_USERNAME=root
DB_PASSWORD=
```

Run `php artisan migrate:fresh --seed` again.

## What's built (this pass)

**Storefront** (`routes/web.php`)
- Home, Salon Services list + detail, Booking flow (form → no-double-book check →
  confirmation), Shop list (filter/sort/search) + product detail, session Cart,
  Checkout (delivery/pickup, COD) → order confirmation, About, Contact (saves
  messages), policy pages.
- Arabic RTL by default, English via `/locale/en`. Locale held in session by
  `App\Http\Middleware\SetLocale`.
- Prices in OMR (3 decimals). Free delivery over OMR 20, else OMR 2 flat —
  see `App\Support\Cart`.

**Admin** (Filament) — full CRUD for Branches, Service Categories, Services,
Staff, Bookings, Product Categories, Products, Orders, Contact Messages. All
content fields are bilingual (English / Arabic inputs side by side).

**Sample data** — `database/seeders/DatabaseSeeder.php` seeds 2 branches,
4 service categories / 11 services, 4 staff, 3 product categories / 12 products,
all bilingual.

## Not done yet (see `docs/WORKFLOW.md` for the full plan)

- Real payment gateway (Thawani/Amwal) — checkout is Cash-on-Delivery only; a
  `card` option is stubbed and disabled.
- Customer accounts / login (booking & checkout are guest-only right now).
- Staff working hours + real availability calculator — booking currently offers
  fixed hourly slots 10:00–19:00 and only blocks exact duplicate slots.
- Email/SMS/WhatsApp confirmations & reminders (mail is set to `log`).
- Stock is decremented immediately on order (not on payment).
- Product/service images use generated gradient placeholders until real photos
  are uploaded in the admin.
- Policy page copy is placeholder text.
