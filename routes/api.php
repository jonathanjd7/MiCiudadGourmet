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
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// =============================================================================
// RUTAS DE AUTENTICACIÓN (SIN TOKEN)
// =============================================================================

// POST /api/auth/register - Registrar nuevo usuario
Route::post('/auth/register', [AuthController::class, 'register']);

// POST /api/auth/login - Iniciar sesión
Route::post('/auth/login', [AuthController::class, 'login']);

// =============================================================================
// RUTAS PROTEGIDAS (CON TOKEN)
// =============================================================================

Route::middleware('auth:sanctum')->group(function () {
    
    // -------------------------------------------------------------------------
    // AUTENTICACIÓN (con token)
    // -------------------------------------------------------------------------
    
    // POST /api/auth/logout - Cerrar sesión
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    
    // GET /api/auth/me - Obtener datos del usuario autenticado
    Route::get('/auth/me', [AuthController::class, 'me']);
    
    // -------------------------------------------------------------------------
    // GESTIÓN DE USUARIOS
    // UserController: index(), store(), show(), update(), destroy()
    // -------------------------------------------------------------------------
    
    // GET /api/users - Listar todos los usuarios
    Route::get('/users', [UserController::class, 'index']);
    
    // POST /api/users - Crear nuevo usuario
    Route::post('/users', [UserController::class, 'store']);
    
    // GET /api/users/{id} - Mostrar usuario específico
    Route::get('/users/{user}', [UserController::class, 'show']);
    
    // PUT /api/users/{id} - Actualizar usuario completo
    Route::put('/users/{user}', [UserController::class, 'update']);
    
    // PATCH /api/users/{id} - Actualizar usuario parcial
    Route::patch('/users/{user}', [UserController::class, 'update']);
    
    // DELETE /api/users/{id} - Eliminar usuario
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
    
    // -------------------------------------------------------------------------
    // GESTIÓN DE RESTAURANTES
    // RestaurantController: index(), store(), show(), update(), destroy()
    // -------------------------------------------------------------------------
    
    // GET /api/restaurants - Listar todos los restaurantes
    Route::get('/restaurants', [RestaurantController::class, 'index']);
    
    // POST /api/restaurants - Crear nuevo restaurante
    Route::post('/restaurants', [RestaurantController::class, 'store']);
    
    // GET /api/restaurants/{id} - Mostrar restaurante específico
    Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show']);
    
    // PUT /api/restaurants/{id} - Actualizar restaurante completo
    Route::put('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
    
    // PATCH /api/restaurants/{id} - Actualizar restaurante parcial  
    Route::patch('/restaurants/{restaurant}', [RestaurantController::class, 'update']);
    
    // DELETE /api/restaurants/{id} - Eliminar restaurante
    Route::delete('/restaurants/{restaurant}', [RestaurantController::class, 'destroy']);
    
    // -------------------------------------------------------------------------
    // GESTIÓN DE PLATOS
    // DishController: index(), store(), show(), update(), destroy()
    // -------------------------------------------------------------------------
    
    // GET /api/dishes - Listar todos los platos
    Route::get('/dishes', [DishController::class, 'index']);
    
    // POST /api/dishes - Crear nuevo plato
    Route::post('/dishes', [DishController::class, 'store']);
    
    // GET /api/dishes/{id} - Mostrar plato específico
    Route::get('/dishes/{dish}', [DishController::class, 'show']);
    
    // PUT /api/dishes/{id} - Actualizar plato completo
    Route::put('/dishes/{dish}', [DishController::class, 'update']);
    
    // PATCH /api/dishes/{id} - Actualizar plato parcial
    Route::patch('/dishes/{dish}', [DishController::class, 'update']);
    
    // DELETE /api/dishes/{id} - Eliminar plato
    Route::delete('/dishes/{dish}', [DishController::class, 'destroy']);
    
    // -------------------------------------------------------------------------
    // RUTAS ADICIONALES
    // -------------------------------------------------------------------------
    
    // GET /api/restaurants/{restaurant}/dishes - Platos de un restaurante
    Route::get('/restaurants/{restaurant}/dishes', [RestaurantController::class, 'dishes']);
    
    // Ruta original de Laravel (mantener para compatibilidad)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// =============================================================================
// RUTAS PÚBLICAS (SIN AUTENTICACIÓN)
// =============================================================================

// GET /api/public/restaurants - Restaurantes públicos
Route::get('/public/restaurants', [RestaurantController::class, 'publicIndex']);

// GET /api/public/restaurants/{id} - Restaurante público específico
Route::get('/public/restaurants/{restaurant}', [RestaurantController::class, 'publicShow']);
