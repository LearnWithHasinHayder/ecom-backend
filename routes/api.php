<?php

use App\Http\Controllers\HydraController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WishlistController;
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

//use the middleware 'hydra.log' with any request to get the detailed headers, request parameters and response logged in logs/laravel.log

Route::get('hydra', [HydraController::class, 'hydra']);
Route::get('hydra/version', [HydraController::class, 'version']);

Route::apiResource('users', UserController::class)->except(['edit', 'create', 'store', 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{user}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::post('users/{user}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::patch('users/{user}', [UserController::class, 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::get('me', [UserController::class, 'me'])->middleware('auth:sanctum');
Route::post('login', [UserController::class, 'login']);

Route::apiResource('roles', RoleController::class)->except(['create', 'edit'])->middleware(['auth:sanctum', 'ability:admin,super-admin,user']);
Route::apiResource('users.roles', UserRoleController::class)->except(['create', 'edit', 'show', 'update'])->middleware(['auth:sanctum', 'ability:admin,super-admin']);

Route::get(
    '/products',
    [ProductController::class, 'index'],
);
Route::get(
    '/products/{id}',
    [ProductController::class, 'product']
);

Route::post(
    '/orders',
    [OrderController::class, 'createOrder']
)->middleware('auth:sanctum');

Route::get(
    '/orders',
    [OrderController::class, 'getUserOrders']
)->middleware('auth:sanctum');

Route::get(
    '/orders/{id}',
    [OrderController::class, 'getOrderDetails']
)->middleware('auth:sanctum');

Route::post(
    '/wishlist',
    [WishlistController::class, 'addToWishList']
)->middleware('auth:sanctum');

Route::get(
    '/wishlist',
    [WishlistController::class, 'getWishList']
)->middleware('auth:sanctum');

Route::delete(
    '/wishlist/{product_id}',
    [WishlistController::class, 'removeFromWishList']
)->middleware('auth:sanctum');
