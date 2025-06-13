<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'phone',
        'description',
        'user_id', // Clave foránea para el usuario dueño
    ];

    // --- Relaciones Eloquent ---

    /**
     * Un restaurante pertenece a un usuario (su dueño).
     * Relación: BelongsTo
     * Inferencia de Laravel: Busca una clave foránea `user_id` en la tabla `restaurants`
     * (el nombre del método `user` + `_id`).
     * Clave foránea: user_id (en la tabla restaurants)
     * Clave padre: id (de la tabla users)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        // Si la clave foránea no fuera user_id, se especificaria:
        // return $this->belongsTo(User::class, 'owner_id');
        return $this->belongsTo(User::class);
    }

    /**
     * Un restaurante puede tener muchas reseñas.
     * Relación: HasMany
     * Inferencia de Laravel: Busca una clave foránea `restaurant_id` en la tabla `reviews`.
     * Clave local: id (de la tabla restaurants)
     * Clave foránea: restaurant_id (en la tabla reviews)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Un restaurante puede pertenecer a muchas categorías y una categoría puede tener muchos restaurantes.
     * Relación: BelongsToMany (muchos a muchos)
     * Inferencia de Laravel:
     * - Busca una tabla pivote llamada `category_restaurant` (orden alfabético de los modelos).
     * - Busca `restaurant_id` y `category_id` como claves foráneas en la tabla pivote.
     * Cuándo especificar manualmente: Cuando la tabla pivote o las claves foráneas no siguen el patrón.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        // Si la tabla pivote o las claves no siguieran la convención:
        // return $this->belongsToMany(Category::class, 'restaurant_category', 'restaurant_id', 'category_id');
        return $this->belongsToMany(Category::class);
    }

    /**
     * Un restaurante puede tener muchas fotos (polimórficas).
     * Relación: MorphMany
     * Inferencia de Laravel: Busca las columnas `imageable_id` y `imageable_type` en la tabla `photos`.
     * `imageable_id` almacenará el ID del modelo padre (Restaurant en este caso).
     * `imageable_type` almacenará el nombre de la clase del modelo padre (App\Models\Restaurant).
     * El primer argumento es la clase del modelo hijo (`Photo::class`).
     * El segundo argumento (`imageable`) es el "prefijo" del nombre de las columnas polimórficas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    /**
     * Un restaurante puede ser favorito de muchos usuarios.
     * Esta es la relación inversa de `User::favorites()`.
     * Relación: BelongsToMany (muchos a muchos)
     * Inferencia de Laravel:
     * - Usa la misma tabla pivote `favorites` definida en `User::favorites()`.
     * - Busca `restaurant_id` y `user_id` como claves foráneas en la tabla pivote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoritedByUsers()
    {
        // Aquí también se especificaría la tabla pivote si no fuera 'favorites'
        // return $this->belongsToMany(User::class, 'favorites', 'restaurant_id', 'user_id');
        return $this->belongsToMany(User::class, 'favorites');
    }
}

 /**
     * Scope para filtrar solo restaurantes activos
     * Uso: Restaurant::active()->get()
     */
    public function scopeActive($query)
    {
        // Filtra solo restaurantes con status = 'active'
        return $query->where('status', 'active');
    }

    /**
     * Scope para filtrar restaurantes por usuario
     * Uso: Restaurant::byUser($userId)->get()
     */
    public function scopeByUser($query, $userId)
    {
        // Filtra restaurantes por ID de usuario
        return $query->where('user_id', $userId);
    }

    /**
     * Scope para buscar restaurantes por nombre
     * Uso: Restaurant::searchByName('Pizza')->get()
     */
    public function scopeSearchByName($query, $name)
    {
        // Busca restaurantes que contengan el nombre
        return $query->where('name', 'LIKE', '%' . $name . '%');
    }
