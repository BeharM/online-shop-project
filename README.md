# Project Installation Guide

This document provides step-by-step instructions on how to install and set up the project you have created using Laravel.

## Prerequisites

Before you begin, ensure you have the following software and tools installed on your system:

- **PHP**: Laravel requires PHP to run. You can download and install PHP from the [official PHP website](https://www.php.net/).

- **Composer**: Composer is a PHP package manager. You can download and install Composer from the [official Composer website](https://getcomposer.org/).

- **Node.js and NPM**: If your project uses JavaScript or CSS preprocessing, you'll need Node.js and NPM. You can download and install them from the [official Node.js website](https://nodejs.org/).

- **Git**: Project is stored in a Git repository, so you will need Git to clone it or use terminal(CMD). You can download Git from the [official Git website](https://git-scm.com/).

- **Database Server**: Laravel project uses MySQL. Make sure you have a database server installed and running.

## Installation Steps

Follow these steps to install and set up your Laravel project:

1. **Clone the Project**:

   Open a terminal and navigate to the directory where you want to store your project. Clone your project's Git repository using the following command:

   ```bash
   git clone <repository_url>
   ```

2. **Install PHP Dependencies**:

   Navigate to the project's root directory using the terminal and run the following command to install PHP dependencies using Composer:

   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies **:

   Project uses JavaScript packages, navigate to the project's root directory and run the following command to install JavaScript dependencies using NPM or Yarn:

   ```bash
   npm install
   # OR
   yarn install
   ```

4. **Configuration**:

    - Copy the `.env.example` file to `.env` and configure your application settings such as database connection information and app key. You can do this manually or by running:

   ```bash
   cp .env.example .env
   ```

    - Generate a new application key:

   ```bash
   php artisan key:generate
   ```

5. **Database Migration**:

   Run the following command to create the database tables using migrations:

   ```bash
   php artisan migrate
   ```

6. **Database Seeding (Optional)**:

   You can run the seeder(s) using:

   ```bash
   php artisan db:seed
   ```

7. **Start the Development Server**:

   Run the following command to start the development server:

   ```bash
   php artisan serve
   ```

   Your Laravel application should now be accessible at `http://localhost:8000`.

8**Run NPM**:

   Run the following command to start the development server:

   ```bash
   npm run dev
   ```
   
9**Access the Application**:

   Open your web browser and go to `http://localhost:8000` to access your Laravel application. You can now log in using the provided credentials or register a new user as needed.

## Conclusion

Admin Login: <br>email = admin@gmail.com <br>
password = password <br>
or you can register new user and use your credentials.

Your Laravel project is now successfully installed and set up. If you encounter any issues during the installation process, refer to the Laravel documentation or seek help from the Laravel community for further assistance. Enjoy working on your project!
