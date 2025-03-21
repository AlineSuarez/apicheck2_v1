<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Apiario;
use App\Models\Colmena;
use App\Models\Region;
use App\Models\Comuna;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'razon_social',
        'id_region',
        'id_comuna',
        'numero_registro',
        'email_disponible',
        'rut',
        'telefono',
        'estado_usuario',
        'plan',
        'fecha_vencimiento',
        'webpay_status',
        'direccion', //añadido
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function colmenas()
    {
        return $this->hasManyThrough(Colmena::class, Apiario::class, 'user_id', 'apiario_id');
    }

    public function apiarios()
    {
        return $this->hasMany(Apiario::class, 'user_id'); // 'user_id' es la clave foránea en Apiario que referencia al usuario
    }

    /**
     * Get the region associated with the user.
     */
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region'); // 'id_region' es la clave foránea en users
    }

    /**
     * Get the comuna associated with the user.
     */
    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'id_comuna'); // 'id_comuna' es la clave foránea en users
    }

    public function payments()
{
    return $this->hasMany(Payment::class);
}
}
