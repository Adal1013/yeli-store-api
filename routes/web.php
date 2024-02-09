<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () return view('welcome');});

Route::get('pdf/users', [UserController::class, 'usersPdf']);
Route::get('pdf/categories', [CategoryController::class, 'categoriesPdf']);
Route::get('roles/exportPDF', [OrderController::class, 'exportPDF']);
Route::get('products/exportPDF', [ProductController::class, 'exportPDF']);
Route::get('orders/exportPDF', [RoleController::class, 'exportPDF']);
