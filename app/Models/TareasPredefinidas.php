<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\TareaGeneral;
class TareasPredefinidas extends Model
{
    use HasFactory;

    /**
     * Tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'tareas_predefinidas';

    /**
     * Atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = [
        'tarea_general_id', // Foreign key de Tareas Generales
        'nombre',

    ];

    /**
     * Relación con la tabla Tareas Generales.
     * Una subtarea pertenece a una Tarea General.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tareaGeneral()
    {
        return $this->belongsTo(TareaGeneral::class, 'tarea_general_id');
    }

}