# Swilen Framework Template

## Create project

It's recommended that you use [Composer](https://getcomposer.org/) to create Swilen project.
This will create a Swilen project with all the required dependencies. Swilen requires PHP 7.3 or later.

```bash
$ composer create-project swilen/swilen swilen
```

## Project structure

Composer generate current project structure.

```bash
📦swilen
 ┣ 📂app
 ┃ ┣ 📂Modules
 ┃ ┃ ┣ 📂Payments
 ┃ ┃ ┃ ┣ 📜PaymentController.php
 ┃ ┃ ┃ ┗ 📜PaymentService.php
 ┃ ┃ ┗ 📂Users
 ┃ ┃ ┃ ┣ 📜UserController.php
 ┃ ┃ ┃ ┗ 📜UserService.php
 ┃ ┣ 📂Shared
 ┃ ┃ ┣ 📂Http
 ┃ ┃ ┃ ┣ 📂Controller
 ┃ ┃ ┃ ┃ ┗ 📜Controller.php
 ┃ ┃ ┃ ┗ 📂Middleware
 ┃ ┃ ┃ ┃ ┗ 📜Authenticate.php
 ┃ ┃ ┗ 📂Providers
 ┃ ┃ ┃ ┣ 📜RouteServiceProvider.php
 ┃ ┃ ┃ ┗ 📜SecurityServiceProvider.php
 ┃ ┣ 📂storage
 ┃ ┃ ┣ 📂logs
 ┃ ┃ ┃ ┣ 📜.gitkeep
 ┃ ┃ ┃ ┗ 📜swilen-2022-10-06.log
 ┃ ┃ ┗ 📂public
 ┃ ┃ ┃ ┣ 📜.gitkeep
 ┃ ┃ ┃ ┗ 📜swilen.png
 ┃ ┣ 📜app.config.php
 ┃ ┣ 📜app.php
 ┃ ┗ 📜app.routes.php
 ┣ 📂public
 ┃ ┣ 📜.htaccess
 ┃ ┗ 📜index.php
 ┣ 📂vendor
 ┣ 📜.editorconfig
 ┣ 📜.env.example
 ┣ 📜.gitignore
 ┣ 📜composer.json
 ┣ 📜composer.lock
 ┣ 📜README.me
```

### Bootstrapping files

📜`swilen/public/index.php`. This is entry point the application.

```PHP
<?php

define('SWILEN_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/
require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Require Swilen Application instance
|--------------------------------------------------------------------------
*/
$swilen = require_once __DIR__.'/../app/app.php';

/*
|--------------------------------------------------------------------------
| Create new request instance from PHP superglobals
|--------------------------------------------------------------------------
*/
$request = Swilen\Http\Request::create();

/*
|--------------------------------------------------------------------------
| Handle the incoming request and retrieve the response
|--------------------------------------------------------------------------
*/
$response = $swilen->handle($request);

/*
|--------------------------------------------------------------------------
| Terminate application response
|--------------------------------------------------------------------------
*/
$response->terminate();

```

📜`swilen/app/app.php`. The application definition.

```PHP
<?php

/*
|--------------------------------------------------------------------------
| Create Swilen application instance
|--------------------------------------------------------------------------
*/
$app = new Swilen\Arthropod\Application(
    $_ENV['SWILEN_BASE_URL'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Return application instance for use outher file
|--------------------------------------------------------------------------
*/
return $app;

```

📜`swilen/app/app.routes.php`. The application routes for api.

```PHP
<?php

use App\Shared\Http\Middleware\Authenticate;
use Swilen\Petiole\Facades\Route;

/*
|--------------------------------------------------------------------------
| Swilen application routes
|--------------------------------------------------------------------------
*/

Route::prefix('users')->group(function () {
    Route::post('/sign-in', [App\Modules\Users\UserController::class, 'userSignIn']);
    Route::post('/sign-up', [App\Modules\Users\UserController::class, 'userSignUp']);
});

Route::prefix('payments')->use(Authenticate::class)->group(function () {
    Route::get('/',         [App\Modules\Payments\PaymentController::class, 'index']);
    Route::get('/{int:id}', [App\Modules\Payments\PaymentController::class, 'find']);
    Route::post('/',        [App\Modules\Payments\PaymentController::class, 'store']);
});

```

📜`swilen/app/app.config.php`. The application config.

```PHP
<?php

/*
|--------------------------------------------------------------------------
| Swilen application config
|--------------------------------------------------------------------------
*/

return [
    // -------------------------------------------------------------------
    // | BASE APPLICATION CONFIG
    // -------------------------------------------------------------------
    'app' => [
        // APPLICATION SECRET KEY
        'secret' => env('APP_SECRET', ''),

        // APPLICATION ENVIRONMENT
        'env' => env('APP_ENV', 'production'),

        // APPLICATION DEBUG
        'debug' => env('APP_DEBUG', false),
    ],

    // ------------------------------------------------------------------
    // | DATABASE CONNECTION CONFIG
    // ------------------------------------------------------------------
    'database' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'schema' => env('DB_SCHEMA', 'swilen'),
        'username' => env('DB_USERNAME', ''),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
        'options' => extension_loaded('pdo_mysql') ? array_filter([
            PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8_unicode_ci;',
        ]) : [],
    ],

    // ------------------------------------------------------------------
    // | CORS CONFIG 'coming soon'
    // ------------------------------------------------------------------
    'cors' => [
        'Allow-Origin' => '*',
        'Allow-Headers' => 'X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method',
        'Allow-Methods' => 'GET, POST, OPTIONS, PUT, DELETE',
        'Allow-Credentials' => true,
        'Max-Age' => 600
    ],

    // ------------------------------------------------------------------
    // | BASE APPLICATION PROVIDERS
    // ------------------------------------------------------------------
    'providers' => [
        \Swilen\Security\SecurityServiceProvider::class,
        \Swilen\Database\DatabaseServiceProvider::class,
        \App\Shared\Providers\RouteServiceProvider::class
    ],
];

```

You may quickly test this using the built-in PHP server:

```bash
$ php -S localhost:8000 -t public
```

## Features

-   [Container](#container)
-   [Database](#database)
-   [Http](#http)
-   [Routing](#routing)
-   [Security](#security)
-   [Validation](#alidation)
-   [Facades](#facade)
