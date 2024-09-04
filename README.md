# Diacare Project 

## Introduction
A diabetes management system project.

## Prerequisites
- PHP >= 7.3
- Composer
- Laravel >= 8.0
- Database (MySQL)

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/Ratified/Diacare.git
   cd Diacare

2. **Install the dependencies**
    ```bash
    composer install
    ```

3. **Copy the .env file**
    ```bash
    cp .env.example .env
    ```

4. **Generate Key**
    ```bash
    php artisan key:generate
    ```

4. **Set up the database file correctly**
    Update your .env file ensure it looks like this at the connection area

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=diacare
    DB_USERNAME=root
    DB_PASSWORD=
    ```


4. **Run migrations to create your database**
    ```bash
    php artisan migrate
    ```

5. **Seed the Database**
    ```bash
    php artisan db:seed
    ```

6. **Run the development server**
    ```bash 
    php artisan serve
    ```