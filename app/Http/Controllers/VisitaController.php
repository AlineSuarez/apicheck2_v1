<?php
namespace App\Http\Controllers;

use App\Models\Apiario;
use App\Models\Visita;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
class VisitaController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $apiarios = Apiario::where('user_id', auth()->id())->get();
        return view('visitas.index', compact('apiarios','user'));
    }
    public function show(Apiario $apiario)
    {
        $visitas = $apiario->visitas()->latest()->get();
        return view('visitas.show', compact('apiario', 'visitas'));
    }
    public function create($id_apiario)
    {
        $user = auth()->user();
        $apiario = Apiario::where('user_id', auth()->id())
        ->where('id', $id_apiario)
        ->first();

    // Verificar si el apiario existe
    if (!$apiario) {
        abort(404, 'Apiario no encontrado.');
    }

    return view('visitas.create', compact('apiario','user'));
    }
    public function primeraInspeccion($id_apiario)
    {
        $user = auth()->user();

        // Obtener el apiario del usuario autenticado
        $apiario = Apiario::where('user_id', auth()->id())
            ->where('id', $id_apiario)
            ->first();

        // Verificar si el apiario existe
        if (!$apiario) {
            abort(404, 'Apiario no encontrado.');
        }

        // Obtener las visitas asociadas al apiario
        $visita = Visita::where('apiario_id', $id_apiario)
        ->where('tipo_visita', 'Primera Visita')
        ->first();

        // Pasar los datos a la vista
        return view('visitas.create1', compact('apiario', 'user', 'visita'));
    }

    public function store1(Request $request, Apiario $apiario)
    {
         // Asegúrate de que el apiario pertenece al usuario autenticado
    // Validar los datos enviados
            $validated = $request->validate([
                'numero_colmenas_activas' => 'required',
                'numero_colmenas_enfermas' => 'required',
                'numero_colmenas_muertas' => 'required',
                'observaciones' => 'required|string',
                'fecha_visita' => 'string',
            ]);


        $visita = new Visita();
        $visita->apiario_id=$apiario->id;;
        $visita->fecha_visita = $validated['fecha_visita'] ?? Carbon::now();
        $visita->num_colmenas_totales = $validated['numero_colmenas_activas'];
        $visita->num_colmenas_enfermas = $validated['numero_colmenas_enfermas'];
       // $visita->num_colmenas_muertas = $validated['numero_colmenas_muertas'];
        $visita->num_colmenas_inspeccionadas  =$apiario->num_colmenas;
        $visita->tipo_visita = 'Primera Visita';
        $visita->observacion_primera_visita = $validated['observaciones'];

        $visita->save();



        return redirect()->route('visitas.create1', $apiario)->with('success', 'Visita registrada correctamente.');
    }
    public function store(Request $request, Apiario $apiario)
    {
         // Asegúrate de que el apiario pertenece al usuario autenticado

        // Validar los datos enviados
            $validated = $request->validate([
                'pcc1_vigor_total' => 'required|string',
                'pcc1_activity_total' => 'required|string',
                'pcc1_pollen_total' => 'required|string',
                'pcc1_block_total' => 'required|string',
                'pcc1_cells_total' => 'required|string',
                'pcc2_postura_total' => 'required|string',
                'pcc2_cria_total' => 'required|string',
                'pcc2_zanganos_total' => 'required|string',
                'pcc3_reserva_total' => 'required|string',
                'pcc4_varroa_total' => 'required|string',
                'fecha_visita' => 'string',
            ]);

        $visita = new Visita();
        $visita->fecha_visita = $validated['fecha_visita'] ?? Carbon::now();
        $visita->apiario_id=$apiario->id;
        $visita->vigor_de_colmena = $validated['pcc1_vigor_total'];
        $visita->actividad_colmena = $validated['pcc1_activity_total'];
        $visita->ingreso_pollen = $validated['pcc1_pollen_total'];
        $visita->bloqueo_camara_cria = $validated['pcc1_block_total'];
        $visita->presencia_celdas_reales = $validated['pcc1_cells_total'];
        $visita->postura_de_reina = $validated['pcc2_postura_total'];
        $visita->estado_de_cria = $validated['pcc2_cria_total'];
        $visita->postura_zanganos = $validated['pcc2_zanganos_total'];
        $visita->reserva_alimento = $validated['pcc3_reserva_total'];
        $visita->presencia_varroa = $validated['pcc4_varroa_total'];
        $visita->tipo_visita = 'Inspección General';
        $visita->save();



        return redirect()->route('visitas.create', $apiario)->with('success', 'Visita registrada correctamente.');
    }

    public function showHistorial($apiarioId)
    {
        // Obtener el apiario y sus visitas
        $apiario = Apiario::with('visitas')->findOrFail($apiarioId);

        // Retornar la vista de historial con los datos del apiario y sus visitas
        return view('visitas.historial', compact('apiario'));
    }
}
