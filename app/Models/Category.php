<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    // --- Relaciones Eloquent ---

    /**
     * Una categoría puede tener muchos restaurantes (muchos a muchos).
     * Relación: BelongsToMany
     * Inferencia de Laravel:
     * - Busca una tabla pivote llamada `category_restaurant` (orden alfabético de los modelos).
     * - Busca `category_id` y `restaurant_id` como claves foráneas en la tabla pivote.
     * Esta es la propiedad inversa de `Restaurant::categories()`.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function restaurants()
    {
        // Si la tabla pivote o las claves no siguieran la convención:
        // return $this->belongsToMany(Restaurant::class, 'restaurant_category', 'category_id', 'restaurant_id');
        return $this->belongsToMany(Restaurant::class);
    }
}
