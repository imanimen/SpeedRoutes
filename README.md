# SpeedRoutes
# How to install
`composer require imanimen/speed-routes`
# How It Works?
- `php artisan make:action Hello`
    - for setting the method in cli use `--method=<METHOD>`
    - for using in specific Module use `--module=<MODULE>`
- open the file 'app/Actions/HelloAction.php'
- php artisan serve 
- open url -> "http://localhost:8000/Hello"
# Add your Logic, Validations, Method and Middlewares inside one file