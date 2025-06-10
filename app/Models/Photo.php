<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'imageable_id',   // Clave foránea polimórfica
        'imageable_type', // Tipo de modelo polimórfico
    ];

    // --- Relaciones Eloquent ---

    /**
     * Una foto pertenece a un modelo polimórfico (Restaurant, User, etc.).
     * Relación: MorphTo
     * Inferencia de Laravel: Busca las columnas `imageable_id` y `imageable_type` en la tabla `photos`.
     * `imageable_id` contendrá el ID del modelo padre.
     * `imageable_type` contendrá el nombre completo de la clase del modelo padre.
     * El argumento opcional es el "prefijo" del nombre de las columnas polimórficas (el mismo que en morphMany).
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
        // Si las columnas no fueran 'imageable_id' y 'imageable_type', se especificarían:
        // return $this->morphTo('imageable', 'my_imageable_type', 'my_imageable_id');
    }
}
