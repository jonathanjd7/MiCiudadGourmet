<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

 // ===== SCOPES =====
    
    /**
     * Scope para filtrar solo usuarios activos
     * Uso: User::active()->get()
     */
    public function scopeActive($query)
    {
        // Filtra solo usuarios con status = 'active'
        return $query->where('status', 'active');
    }

    /**
     * Scope para filtrar usuarios por rol
     * Uso: User::byRole('owner')->get()
     */
    public function scopeByRole($query, $role)
    {
        // Filtra usuarios por rol específico
        return $query->where('role', $role);
    }

    /**
     * Scope para obtener propietarios de restaurantes
     * Uso: User::owners()->get()
     */
    public function scopeOwners($query)
    {
        // Filtra solo usuarios con rol 'owner'
        return $query->where('role', 'owner');
    }
