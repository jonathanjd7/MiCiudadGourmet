<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'user_id',
        'published_at', // Nuevo campo de ejemplo para demostración de $casts
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2', // Ejemplo: si el precio es un decimal
        'stock' => 'integer',   // Ejemplo: si el stock es un entero
        'published_at' => 'datetime', // Casteo de una fecha personalizada
        'created_at' => 'datetime', // Aunque Laravel lo hace por defecto, se puede explicitar
        'updated_at' => 'datetime', // Aunque Laravel lo hace por defecto, se puede explicitar
    ];
}
