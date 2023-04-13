<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'abilities:user'])->controller(UserController::class)
    ->prefix('users')->group(function () {
        Route::get('/{user_id}', 'getUserById');
        Route::get('/', 'getAllUsers');

        Route::get('/account/{user_id}', 'getUserAccountById');
        Route::get('/account', 'getAllUserAccounts');

        Route::put('/{user_id}', 'updateUserById');
    });

Route::controller(AuthController::class)
    ->prefix('auth')->group(function () {
        Route::post('/sign-up', 'signUp');
        Route::post('/sign-in', 'signIn');
    });
