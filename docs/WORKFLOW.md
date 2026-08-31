# Al Zain — Build Workflow

A bilingual (Arabic + English, RTL) Laravel platform combining **salon booking**
and an **online shop** (skincare, fashion, facials). Booking + shop launch together.

## Stack
- Laravel 11 (PHP 8.2+), MySQL/MariaDB (Laragon)
- Blade + Livewire (or Alpine.js), Tailwind CSS (RTL)
- Filament (admin), Breeze/Fortify (customer auth), Spatie Permission (roles)
- Spatie Media Library (images), Laravel Cashier / gateway SDK (payments)
- mcamara/laravel-localization (AR/EN), spatie/laravel-translatable (bilingual fields)
- Queues + Mail/SMS/WhatsApp (reminders)

Payments: plan for a local Oman gateway (Thawani / Amwal / OmanNet) behind a
payment interface so gateways can be swapped without rewriting checkout.

## Core data model
- Booking: Branches, Services, Staff, Availability, Bookings
- Shop:    Categories, Products (variants/stock/images), Cart, Orders, Payments
- Shared:  Customers

Every customer-facing text field needs an Arabic AND English value. Decide this now.

## Two customer journeys
- Booking: browse services -> pick branch/staff -> see open slots -> confirm ->
  confirmation + reminder -> admin calendar
- Shop: browse catalogue -> product/variant -> cart -> shipping/pickup ->
  pay -> order tracking + admin fulfilment (stock updates)

## Phases
1. **Foundation & setup** (Wk1): Laravel + DB + Tailwind + Filament + auth + AR/EN RTL working
2. **Catalogue & content** (Wk2): bilingual branches/services/products in admin + public listings
3. **Booking engine** (Wk3-4): staff hours, availability calculator, no double-booking, calendar, reminders
4. **Shop & checkout** (Wk4-5): cart, checkout, payment gateway, orders, stock, customer account
5. **Polish, brand & trust** (Wk6): identity, home page, about/contact/policy pages, AR/EN + mobile QA
6. **Test, deploy & launch** (Wk7): full-journey tests, live keys, hosting/SSL/backups/queue worker, soft launch

## Pre-launch checklist
- [ ] No double-booking (same slot, two people)
- [ ] Booking confirmation + reminder send
- [ ] Time zone = Asia/Muscat
- [ ] Payment success AND failure handled
- [ ] Stock drops only on paid orders
- [ ] Every page correct in Arabic (RTL) and English
- [ ] Prices in OMR, formatted correctly
- [ ] Mobile layout for booking and checkout
- [ ] Order/booking emails from your domain
- [ ] Privacy, terms, shipping & returns pages
- [ ] SSL, scheduled backups, queue worker running
- [ ] Admin manages services, products, orders, bookings

## Phase 2 (after launch)
Loyalty tiers (Bronze/Silver/Gold) · reviews & ratings · booking deposits/no-show ·
WhatsApp reminders · multi-branch scaling · gift cards & bundles
