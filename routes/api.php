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
| Aquí defines todas las rutas de tu API.
| Separadas por acceso público y autenticado.
*/

// ============================================================================
// RUTAS PÚBLICAS (NO requieren token)
// ============================================================================
Route::post('/auth/register', [AuthController::class, 'register']);  // Registro de usuarios
Route::post('/auth/login', [AuthController::class, 'login']);        // Login de usuarios

Route::get('/public/restaurants', [RestaurantController::class, 'publicIndex']);   // Listar restaurantes públicos
Route::get('/public/restaurants/{restaurant}', [RestaurantController::class, 'publicShow']); // Ver restaurante público

// ============================================================================
// RUTAS PROTEGIDAS (Requieren token Sanctum)
// ============================================================================
Route::middleware('auth:sanctum')->group(function () {

    // -------------------------
    // Autenticación
    // -------------------------
    Route::post('/auth/logout', [AuthController::class, 'logout']);  // Cerrar sesión
    Route::get('/auth/me', [AuthController::class, 'me']);           // Obtener datos del usuario autenticado

    // -------------------------
    // Usuarios
    // -------------------------
    Route::get('/users', [UserController::class, 'index']);          // Listar usuarios
    Route::post('/users', [UserController::class, 'store']);         // Crear usuario
    Route::get('/users/{user}', [UserController::class, 'show']);    // Ver usuario
    Route::match(['put', 'patch'], '/users/{user}', [UserController::class, 'update']); // Actualizar usuario
    Route::delete('/users/{user}', [UserController::class, 'destroy']); // Eliminar usuario

    // -------------------------
    // Restaurantes
    // -------------------------
    Route::get('/restaurants', [RestaurantController::class, 'index']);    // Listar restaurantes (admin)
    Route::post('/restaurants', [RestaurantController::class, 'store']);   // Crear restaurante
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show']); // Ver restaurante
    Route::match(['put', 'patch'], '/restaurants/{restaurant}', [RestaurantController::class, 'update']); // Actualizar restaurante
    Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']); // Eliminar restaurante

    // Platos de un restaurante específico
    Route::get('/restaurants/{restaurant}/dishes', [RestaurantController::class, 'dishes']);

    // -------------------------
    // Platos
    // -------------------------
    Route::get('/dishes', [DishController::class, 'index']);         // Listar platos
    Route::post('/dishes', [DishController::class, 'store']);        // Crear plato
    Route::get('/dishes/{dish}', [DishController::class, 'show']);   // Ver plato
    Route::match(['put', 'patch'], '/dishes/{dish}', [DishController::class, 'update']); // Actualizar plato
    Route::delete('/dishes/{dish}', [DishController::class, 'destroy']); // Eliminar plato

    // -------------------------
    // Ruta por defecto de Laravel (puedes eliminar si no la usas)
    // -------------------------
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
