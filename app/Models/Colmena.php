<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colmena extends Model
{
    use HasFactory;

    protected $fillable = [
        'apiario_id',
        'nombre',
        'estado_inicial',
        'numero_marcos',
        'observaciones',
    ];

    public function apiario()
    {
        return $this->belongsTo(Apiario::class);
    }

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}