# Dental White-Label Agency Portal — Laravel + Vue

A production-minded starter blueprint for a Canadian dental marketing white-label agency.

**Purpose:** Talha gets dental clients in Canada. Delivery partners handle website/SEO/ads work behind the scenes. Clients see only Talha's agency brand.

## Core modules

- Agency white-label settings: logo, public name, support email, brand color, domain.
- Role-based access: `agency_admin`, `account_manager`, `delivery_team`, `client`.
- Clients/clinics CRM.
- Projects for Website, SEO, Google Business Profile, Google Ads, Content.
- Tasks and deliverables with approval workflow.
- Monthly SEO/reporting module under your agency brand.
- Public audit request lead form for dental clinics.
- Compliance-safe review guidance: no fake reviews, no guaranteed ranking promises.

## Recommended stack

- PHP 8.2+
- Laravel 11 or 12
- MySQL 8 or PostgreSQL 15+
- Vue 3
- Inertia.js
- Vite
- Tailwind CSS

## Run locally

This is a complete Laravel 13 + Vue 3 + Inertia application. It uses SQLite by
default, so no database server is required.

From a fresh clone:

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
npm run build        # or `npm run dev` for hot reloading
php artisan serve
```

Then open http://127.0.0.1:8000.

If `composer install`, `npm install`, and `.env` are already in place, you only
need:

```bash
npm run dev
php artisan serve
```

To switch to MySQL/PostgreSQL, set the `DB_*` values in `.env` and re-run
`php artisan migrate --seed`.

## First admin user

The seeder creates:

- Email: `admin@dentalgrowth.local`
- Password: `Password123!`

Change this before production.

## Roles and permissions

| Role | Access |
|---|---|
| agency_admin | Full access to all clients, projects, reports, settings |
| account_manager | Manage clients, projects, tasks, reports |
| delivery_team | View assigned work, update internal tasks/deliverables only |
| client | View only their own clinic projects, deliverables, and published reports |

## White-label rules in the system

- Delivery users cannot see client contact email/phone by default.
- Client-facing reports use agency settings, not subcontractor branding.
- Reports have draft/published statuses.
- Client users can only access projects connected to their own clinic.

## MVP build order

1. Auth + roles
2. Agency settings
3. Clients/clinics
4. Projects/tasks/deliverables
5. Monthly reports
6. Public audit form
7. Stripe/QuickBooks billing integration later
8. Google Analytics/Search Console/API integrations later

## Important production notes

- Add formal Laravel Policies before launch if permissions become more complex.
- Add file storage using S3-compatible object storage for logos/reports/assets.
- Add activity logs for auditability.
- Add 2FA for agency admins.
- Keep dental claims province-specific and clinic-approved.
