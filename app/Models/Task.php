<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'fecha_inicio',
        'fecha_fin',
        'user_id',
        'priority',
        'apiario_id'
    ];
}