# Laravel Admin Notifications System

This project implements a notifications system in the Laravel admin dashboard, allowing administrators to mark notifications as read and clear all notifications. It features AJAX functionality for real-time updates without requiring page reloads.

## Features

- **Mark All Notifications as Read**: Admins can mark all notifications as read, which updates the notification counter dynamically.
- **Clear All Notifications**: Admins can clear all notifications, removing them from the dashboard.
- **AJAX Integration**: Actions for reading and clearing notifications are performed asynchronously using AJAX, providing a smooth user experience.

## Technologies Used

- **Laravel**: PHP framework for backend functionality.
- **AJAX**: For asynchronous requests, allowing notifications to be updated without a full page refresh.
- **jQuery**: Simplifies the DOM manipulation and AJAX requests.
- **Blade Templates**: For rendering the user interface.
- **Toastr**: (Optional) For notification feedback to the user.

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/Muhammed2024Salama/Real-Time
cd Real-Time

composer install

cp .env.example .env
php artisan key:generate

php artisan migrate


php artisan serve
