# PHP_Laravel12_Cookie_Consent

A complete Laravel 12 Cookie Consent Management System using the **whitecube/laravel-cookie-consent** package. This project demonstrates how to implement GDPR‑compliant cookie consent with category selection, middleware protection, UI banners, and optional database storage.

## Project Overview

This project provides a full end‑to‑end cookie consent solution including banner display, category‑based permissions, route protection, and preference management. It is designed for learning privacy compliance and real‑world web application standards.

---

## Core Features

* Cookie Consent Banner
* Accept All / Reject All / Select Categories
* Necessary, Analytics, Marketing Categories
* Middleware Protected Routes
* Preferences Modal
* Revoke Consent Option
* Helper Functions
* Optional Database Storage
* Console Cleanup Command
* Optional API Endpoints
* Bootstrap Responsive UI
* GDPR‑Compliant Flow

---

## Technology Stack

* PHP 8+
* Laravel 12
* MySQL
* Bootstrap 5
* JavaScript
* whitecube/laravel-cookie-consent Package

---

## Installation Steps

### Step 1 — Create New Laravel Project

composer create-project laravel/laravel laravel-cookie-consent
cd laravel-cookie-consent

### Step 2 — Install Cookie Consent Package

composer require whitecube/laravel-cookie-consent

### Step 3 — Publish Package Assets

php artisan vendor:publish --provider="Whitecube\LaravelCookieConsent\ServiceProvider" --tag="config"
php artisan vendor:publish --provider="Whitecube\LaravelCookieConsent\ServiceProvider" --tag="views"
php artisan vendor:publish --provider="Whitecube\LaravelCookieConsent\ServiceProvider" --tag="translations"

---

## Configuration

File: config/cookie-consent.php

* Enable or disable consent system
* Define cookie lifetime
* Create cookie categories
* Set translation texts

Categories Example:

* necessary
* analytics
* marketing

---

## Middleware

Create CheckCookieConsent middleware to restrict routes until user grants consent.

Register in Kernel.php and apply to protected routes like dashboard or admin panels.

---

## Controller

CookieController handles:

* consent page display
* accept preferences
* update preferences
* revoke consent

---

## Routes

cookie/consent
cookie/accept
cookie/update
cookie/revoke

Protected Example:

/dashboard → requires cookie consent middleware

---

## Views Structure

resources/views/layouts/app.blade.php
resources/views/cookie/banner.blade.php
resources/views/cookie/consent.blade.php
resources/views/cookie/preferences-modal.blade.php
resources/views/welcome.blade.php
resources/views/dashboard.blade.php

UI includes:

* Slide‑up banner
* Toggle switches
* Modal preferences
* Status table

---

## Service Layer

CookieConsentService provides helper methods:

* hasConsent(category)
* getConsent()
* hasAnyConsent()
* getEnabledCategories()

---

## Helper Functions

cookieConsent()
hasCookieConsent('analytics')

Registered via composer autoload files.

---

## Optional Database Storage

Migration: cookie_consents table

Fields:

* ip_address
* user_agent
* consent_given
* categories
* consent_id
* timestamps

Model: CookieConsent

---

## Console Command

Command: cookie:clean-expired

Purpose:

* Remove expired consent records
* Prevent database growth

---

## API Endpoints (Optional)

/api/cookie/status
/api/cookie/consent

Returns JSON consent status and enabled categories.

---

## Application Flow

1. User visits site
2. Banner appears
3. User selects preferences
4. Cookie stored in browser
5. Middleware allows protected pages
6. User can update or revoke anytime

---

## Testing

php artisan serve
Visit [http://localhost:8000](http://localhost:8000)
<img width="1648" height="967" alt="image" src="https://github.com/user-attachments/assets/541c0afd-77b9-48a5-a444-1fdc7efeccc7" />


Test Scenarios:

* Accept All
* Reject All
* Select Categories
* Revoke Consent
* Dashboard Access Restriction

---

## Suggested Enhancements

* Google Analytics Conditional Loading
* Facebook Pixel Consent Check
* Multi‑Language Support
* Cookie Policy Page
* Pattern‑Based Cookie Matching
* Role‑Based Cookie Settings

---

## Use Cases

* GDPR Compliance
* Privacy‑Focused Websites
* SaaS Dashboards
* E‑Commerce Platforms
* Admin Panels

---

## Requirements

* PHP 8+
* Composer
* MySQL
* Node (Optional)
* Laravel 12

---

## License

MIT License

