<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CodeCheckController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puede registrar rutas API para su aplicación. Estas
| rutas son cargadas por RouteServiceProvider y todas ellas pueden
| ser asignado al grupo de middleware "api". ¡Haz algo genial!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Password reset routes
Route::post('password/email',  ForgotPasswordController::class);
Route::get('password/check/{code}', CodeCheckController::class);
Route::post('password/reset', ResetPasswordController::class);
Route::get('users/export/', [UserController::class, 'export']);
Route::get('users/exportPDF/', [UserController::class, 'exportPDF']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', OrderController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/users', UserController::class);
});

