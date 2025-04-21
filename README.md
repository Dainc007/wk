<h1 align="center">Welcome to Pro Clubs wk 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.0-blue.svg?cacheSeconds=2592000" />
  <a href="https://www.heinze.com.pl" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
</p>

> This project aims to establish an e-sports league for EA's Pro Clubs mode. It will provide a competitive platform for players to showcase their skills, engage in structured matches, and foster community interaction. Our goal is to create an exciting environment for players and fans alike, promoting teamwork and sportsmanship. 

### 🏠 [Homepage](https://www.heinze.com.pl)

### ✨ [Demo](https://dev-mlwk.laravel.cloud)

## Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+
- npm or yarn
- PostgreSQL

## Install

```sh
# Clone the repository
git clone https://github.com/Dainc007/wk.git
cd wk

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Copy environment file and configure
cp .env.example .env
php artisan key:generate

php artisan storage:link

# Set up database
php artisan migrate
php artisan db:seed

# Compile frontend assets
npm run dev
```

## Used Packages && Libs

This project leverages several powerful packages to enhance functionality:

- **Spatie Media Library**: Advanced media management and file handling
- **Spatie Permissions**: Robust role and permission management
- **Laravel Shield**: Additional security layers and protection
- **Laravel Breeze**: Lightweight authentication scaffolding
- **Filament**: Elegant admin panel and form builder
- **Tailwind CSS**: Utility-first CSS framework for rapid UI development

## Author

👤 **Daniel Heinze**

* Website: www.heinze.com.pl
* Github: [@Dainc007](https://github.com/Dainc007)
* LinkedIn: [@daniel-heinze-199ab4209\/](https://linkedin.com/in/daniel-heinze-199ab4209\/)
* Pinkary: [@heinzei14i](https://pinkary.com/@heinzei14i)

## 🤝 Contributing

Contributions, issues and feature requests are welcome!<br />Feel free to check [issues page](https://github.com/Dainc007/wk/issues). 

## Show your support

Give a ⭐️ if this project helped you!

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_
