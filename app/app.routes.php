<?php

use App\Shared\Http\Middleware\Authenticate;
use Swilen\Petiole\Facades\Route;

/* ------------------------------------------------------------------- */
/*  Swilen routes definition                                           */
/* ------------------------------------------------------------------- */

Route::prefix('users')->group(function () {
    Route::post('/sign-in', [App\Modules\Users\UserController::class, 'userSignIn']);
    Route::post('/sign-up', [App\Modules\Users\UserController::class, 'userSignUp']);
});

Route::prefix('payments')->group(function () {
    Route::get('/',         [App\Modules\Payments\PaymentController::class, 'index'])->use(Authenticate::class);
    Route::get('/{int:id}', [App\Modules\Payments\PaymentController::class, 'find'])->use(Authenticate::class);
    Route::post('/',        [App\Modules\Payments\PaymentController::class, 'store'])->use(Authenticate::class);
});

Route::get('media/{file}', function ($file) {
    return response()->file(storage_path('public/' . $file));
});
