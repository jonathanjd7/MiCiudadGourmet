<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DishController extends Controller
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
    public function store(Request $request)
    class DishController extends Controller
{
    /**
     * Crear un nuevo plato
     * 
     * @param StoreDishRequest $request
     * @return JsonResponse
     */
    public function store(StoreDishRequest $request): JsonResponse
    {
        try {
            // Crear plato con datos validados
            $dish = Dish::create($request->validated());
            
            // Cargar relación con restaurante
            $dish->load('restaurant');
            
            // Respuesta exitosa
            return response()->json([
                'success' => true,
                'message' => 'Plato creado exitosamente',
                'data' => $dish
            ], 201);
            
        } catch (\Exception $e) {
            // Respuesta de error
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el plato',
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
