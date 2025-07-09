<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions">
    <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
  </a>
  <a href="https://packagist.org/packages/laravel/framework">
    <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
  </a>
</p>

---

# 🎟️ EventEase – Laravel Event Booking System

**EventEase** is a Laravel-based web application for managing events, seats, and bookings  
with real-time seat blocking, retry payment handling, and PDF ticket generation.  
It helps event organizers manage their events and users to easily book seats.

---

## ✨ Features

- Event listing with image, details, and carousel display.
- Seat management by event: add, edit, delete with status (available, blocked, booked).
- Real-time seat blocking: temporarily blocks seats for 5 mins when selected.
- Booking with payment simulation (success/fail with retry logic).
- PDF ticket generation and storage.
- Admin panel to manage events & seats.
- Clear status indicators for seats (booked, temporarily blocked, available).

---

## 🚀 Tech Stack

- **Framework:** Laravel
- **Frontend:** Blade, Bootstrap
- **Database:** MySQL
- **PDF Generation:** barryvdh/laravel-dompdf

---

## ⚙️ Installation

```bash
git clone https://github.com/yourusername/eventease.git
cd eventease
composer install
cp .env.example .env
php artisan key:generate
# Configure your DB settings in .env
php artisan migrate
php artisan db:seed # optional if you have seeders
php artisan serve
