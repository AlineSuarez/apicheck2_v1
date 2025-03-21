<?php

// app/Http/Controllers/ZonificacionController.php

namespace App\Http\Controllers;
use App\Models\Apiario;
use App\Models\Colmena;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class ZonificacionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Obtener apiarios del usuario actual
        $apiarios = $user->apiarios()->get(['latitud', 'longitud', 'tipo_apiario', 'num_colmenas', 'nombre', 'foto']);
    
        // Obtener apiarios de otros usuarios
        $otros_apiarios = Apiario::where('user_id', '!=', $user->id)
            ->get(['latitud', 'longitud', 'tipo_apiario', 'num_colmenas', 'nombre', 'foto']);
    
        // Otras zonas que quieras mostrar
        $zonas = [
            // Información de cada zona...
        ];
    
        return view('zonificacion.index', compact('apiarios', 'otros_apiarios', 'zonas'));
    }
}
