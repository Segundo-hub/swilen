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
| register exception handler
|--------------------------------------------------------------------------
*/
$app->singleton(
    \Swilen\Arthropod\Contract\ExceptionHandler::class,
    \Swilen\Arthropod\Exception\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return application instance for use outher file
|--------------------------------------------------------------------------
*/
return $app;
