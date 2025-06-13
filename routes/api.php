<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RestaurantController;
use App\Http\Controllers\Api\DishController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí registras las rutas de tu API. Se agrupan por autenticación.
|
*/

// ============================================================================
// RUTAS PÚBLICAS (SIN AUTENTICACIÓN)
// ============================================================================

// Registro e inicio de sesión
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Acceso público a restaurantes
Route::get('/public/restaurants', [RestaurantController::class, 'publicIndex']);
Route::get('/public/restaurants/{restaurant}', [RestaurantController::class, 'publicShow']);

// ============================================================================
// RUTAS PROTEGIDAS (CON TOKEN SANCTUM)
// ============================================================================

Route::middleware('auth:sanctum')->group(function () {

    // -----------------------------------------
    // Autenticación
    // -----------------------------------------
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // -----------------------------------------
    // Gestión de usuarios
    // -----------------------------------------
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::patch('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    // -----------------------------------------
    // Gestión de restaurantes
    // -----------------------------------------
    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show']);
    Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
    Route::patch('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
    Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);

    // Platos por restaurante
    Route::get('/restaurants/{restaurant}/dishes', [RestaurantController::class, 'dishes']);

    // -----------------------------------------
    // Gestión de platos
    // -----------------------------------------
    Route::get('/dishes', [DishController::class, 'index']);
    Route::post('/dishes', [DishController::class, 'store']);
    Route::get('/dishes/{dish}', [DishController::class, 'show']);
    Route::put('/dishes/{dish}', [DishController::class, 'update']);
    Route::patch('/dishes/{dish}', [DishController::class, 'update']);
    Route::delete('/dishes/{dish}', [DishController::class, 'destroy']);

    // -----------------------------------------
    // Ruta por defecto de Laravel (mantener)
    // -----------------------------------------
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
