<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
 
    public function store(StoreRestaurantRequest $request): JsonResponse
    {
        try {
            // Crear restaurante con datos validados
            $restaurant = Restaurant::create($request->validated());
            
            // Respuesta exitosa
            return response()->json([
                'success' => true,
                'message' => 'Restaurante creado exitosamente',
                'data' => $restaurant
            ], 201);
            
        } catch (\Exception $e) {
            // Respuesta de error
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el restaurante',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
