Laravel 10   Online Bookstore with Recommendation Engine

1. Rename .env-example to .env and set database name as your phpMyAdmin

2. Run these below commands in project terminal
    $ composer update
    $ php artisan key:generate
    $ php artisan migrate
    $ php artisan db:seed
    $ php artisan serve

3. composer require laravel/helpers
4. composer require "darryldecode/cart"
5. composer require laravelcollective/html
6. php artisan vendor:publish --tag=laravel-pagination

    Now this project is ready to run. 
    For admin, Email `admin@bookshop.com` password `secret`. 
    For user, Email `user@bookshop.com` password `secret`.
 