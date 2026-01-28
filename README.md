# 🌤️ SkyCast - Laravel Weather App

A modern, full-stack weather application built with **Laravel 11**, **Vue 3**, **Inertia.js**, and **Tailwind CSS**.

## 🚀 Key Features

- **Real-time Weather**: Integrated with OpenWeatherMap API.
- **Dynamic UI**: "Aurora Glass" theme that adapts to weather conditions (Dark/Glassmorphism).
- **Architecture Refactor**: All standard Controllers replaced with **Single Action Classes** using `lorisleiva/laravel-actions`.
- **Full Authentication**: Login, Register, Password Reset, and Profile Management (Edit/Delete).

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Vue 3 (Composition API) + Inertia.js
- **Styling**: Tailwind CSS
- **Package**: lorisleiva/laravel-actions

## ⚙️ Setup Instructions

1. **Clone the repository**
    ```bash
    git clone https://github.com/davamoreno/SkyCast.git

2. **Install Dependencies**

    ```Bash
    composer install
    npm install
    Environment Setup Copy .env.example to .env:
    cp .env.example .env
    Add your OpenWeatherMap API Key in .env:

3. **Cuplikan kode**
    OPENWEATHER_API_KEY=your_api_key_here

4. **Prepare Database**

    ```Bash
    php artisan key:generate
    php artisan migrate
    Run Application Open two terminals:
    npm run dev
    Bash
    php artisan serve