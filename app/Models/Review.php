<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rating',
        'comment',
        'user_id',      // Clave foránea para el usuario que hizo la reseña
        'restaurant_id', // Clave foránea para el restaurante reseñado
    ];

    // --- Relaciones Eloquent ---

    /**
     * Una reseña pertenece a un usuario.
     * Relación: BelongsTo
     * Inferencia de Laravel: Busca una clave foránea `user_id` en la tabla `reviews`.
     * Clave foránea: user_id (en la tabla reviews)
     * Clave padre: id (de la tabla users)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Una reseña pertenece a un restaurante.
     * Relación: BelongsTo
     * Inferencia de Laravel: Busca una clave foránea `restaurant_id` en la tabla `reviews`.
     * Clave foránea: restaurant_id (en la tabla reviews)
     * Clave padre: id (de la tabla restaurants)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
