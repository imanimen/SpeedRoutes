# SpeedRoutes
# Add your Logic, Validations, Method and Middlewares in one class 😎
# install
`composer require imanimen/speed-routes`
# Usage
- `php artisan make:action Hello`
    - to set the method in cli `--method=<METHOD>`
    - to use in specific Module `--module=<MODULE>`
- open the file 'app/Actions/HelloAction.php' if `--module=` open it in `<MODULE>/app/Actions/HelloAction.php`
- php artisan serve 
- open url -> "http://localhost:8000/Hello"