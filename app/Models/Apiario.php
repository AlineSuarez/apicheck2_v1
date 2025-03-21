<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comuna;
class Apiario extends Model
{
    use HasFactory;

    // Definir los atributos que pueden ser asignados masivamente
    protected $fillable = [
        'user_id', // Relación con el usuario
        'temporada_produccion',
        'registro_sag',
        'num_colmenas',
        'tipo_apiario',
        'tipo_manejo',
        'objetivo_produccion',
        'region_id', // Agregar esta línea
        'comuna_id', // Agregar esta línea
        'latitud', // Agregar esta línea
        'longitud', // Agregar esta línea
        'localizacion', // Agregar esta línea
        'nombre',//
        'nombre_comuna',//
        'url'
    
    ];
 
    /**
     * Relación: Un apiario pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitas()
{
    return $this->hasMany(Visita::class);
}
public function comuna()
{
    return $this->belongsTo(Comuna::class);
}



    /**
     * Otros métodos adicionales si es necesario
     */
}
