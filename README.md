# Laravel 9 - Test JDS

## Download Project and Save Project in Locally

## change the file named ".env.example" to ".env"

## Create a new database in MySQL with the name "test-jds"

## Run Locally

Run the following command:

```bash
    composer install
```

```bash
    php artisan key:generate
```

```bash
    php artisan migrate:fresh --seed
```

```bash
    php artisan passport:install
```

```bash
    php artisan serve
```

## Username & Password Role (Admin)
email: admin@gmail.com
password: password

## Username & Password Role (User)
email: yadi@gmail.com
password: password

#### access

-   http://127.0.0.1:8000/api/news
