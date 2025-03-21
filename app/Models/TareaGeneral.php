<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubTarea;
use App\Models\TareasPredefinidas;

class TareaGeneral extends Model
{
    use HasFactory;

 protected $table = 'tareas_generales';
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subtareas()
    {
        return $this->hasMany(Subtarea::class);
    }
    public function predefinidas()
    {
        return $this->hasMany(TareasPredefinidas::class);
    }
    
    public function calcularProgreso()
    {
        // Obtén el total de subtareas
        $totalSubtareas = $this->subtareas->count();

        // Si no hay subtareas, el progreso es 0
        if ($totalSubtareas === 0) {
            return 0;
        }

        // Cuenta las subtareas completadas y en progreso
        $subtareasCompletadas = $this->subtareas->where('estado', 'Completada')->count();
        $subtareasEnProgreso = $this->subtareas->where('estado', 'En progreso')->count();

        // Calcula la contribución de las subtareas completadas (100%)
        $progresoCompletadas = ($subtareasCompletadas / $totalSubtareas) * 100;

        // Calcula la contribución de las subtareas en progreso (máximo 50%)
        $progresoEnProgreso = ($subtareasEnProgreso / $totalSubtareas) * 50;

        // Suma las contribuciones
        $progresoTotal = $progresoCompletadas + $progresoEnProgreso;

        return round($progresoTotal); // Redondea el progreso al número entero más cercano
    }

}