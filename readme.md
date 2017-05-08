Clone the repository

`composer install`

Copy `.env.example` to `.env`

`php artisan key:generate`

Put your MySql database credentials into `.env` ( DB_HOST DB_HOST DB_DATABASE DB_USERNAME DB_PASSWORD)

`php artisan migrate`

`php artisan import:employees`

`php artisan serve` or setup your webserver to point to the public folder of the project with write permissions on `bootstrap/cache` and `storage` recursive.

go to `http://127.0.0.1:8000`
