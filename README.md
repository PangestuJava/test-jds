# Laravel 9 - Test JDS

## Run Locally

Customize database in the .env file

```bash
  DB_DATABASE=...
```

Create a new database on the localserver according to the DB_DATABASE

```bash
    composer install
```

```bash
    php artisan key:generate
```

```bash
    php artisan artisan migrate:fresh --seed
```

```bash
    php artisan serve
```

#### access

-   http://127.0.0.1:8000/
