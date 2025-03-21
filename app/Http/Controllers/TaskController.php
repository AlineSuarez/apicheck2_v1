<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TareaGeneral;
use App\Models\SubTarea;
use App\Models\TareasPredefinidas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class TaskController extends Controller
{
   
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Obtener solo las subtareas que pertenecen al usuario autenticado
        $subtareas = Subtarea::where('user_id', $user->id)->get();
    
        // Obtener los ids de las TareasGenerales asociadas a las subtareas
        $tareasGeneralesIds = $subtareas->pluck('tarea_general_id')->unique();
        $listaEtapa=TareaGeneral::with('predefinidas')->get();
        // Obtener las TareasGenerales correspondientes a las subtareas
        $tareasGenerales = TareaGeneral::whereIn('id', $tareasGeneralesIds)
            ->with(['subtareas' => function ($query) use ($user) {
                $query->where('user_id', $user->id); // Cargar solo las subtareas del usuario
            }])
            ->get();
    
        // Obtener los apiarios del usuario autenticado
        $apiarios = $user->apiarios; // Asumiendo que la relación está definida en el modelo User
    
        // Formatear fechas en TareasGenerales y Subtareas
        $tareasGenerales->each(function ($tarea) {
            if ($tarea->fecha_inicio) {
                $tarea->fecha_inicio_formatted = \Carbon\Carbon::parse($tarea->fecha_inicio)->format('d-m-Y');
            }
            if ($tarea->fecha_fin) {
                $tarea->fecha_fin_formatted = \Carbon\Carbon::parse($tarea->fecha_fin)->format('d-m-Y');
            }
    
            // Formatear fechas en cada subtarea
            $tarea->subtareas->each(function ($subtarea) {
                if ($subtarea->fecha_inicio) {
                    $subtarea->fecha_inicio_formatted = \Carbon\Carbon::parse($subtarea->fecha_inicio)->format('d-m-Y');
                }
                if ($subtarea->fecha_limite) {
                    $subtarea->fecha_fin_formatted = \Carbon\Carbon::parse($subtarea->fecha_limite)->format('d-m-Y');
                }
            });
        });
        
        // Devolver la vista con los datos
        return view('tareas.index', compact('subtareas', 'tareasGenerales', 'apiarios','listaEtapa'));
    }
    

    public function loadView($view)
    {
        $user = Auth::user();
    
        // Obtener tareas con subtareas relacionadas
        $tareasGenerales = TareaGeneral::where('user_id', $user->id)
            ->with('subtareas') // Cargar subtareas relacionadas
            ->get();
    
        // Obtener subtareas de todas las TareasGenerales
        $subtareas = $tareasGenerales->flatMap->subtareas; // Extraer subtareas en una sola colección
    
        // Formatear fechas en TareasGenerales y Subtareas
        $tareasGenerales->each(function ($tarea) {
            if ($tarea->fecha_inicio) {
                $tarea->fecha_inicio_formatted = \Carbon\Carbon::parse($tarea->fecha_inicio)->format('d-m-Y');
            }
            if ($tarea->fecha_fin) {
                $tarea->fecha_fin_formatted = \Carbon\Carbon::parse($tarea->fecha_fin)->format('d-m-Y');
            }
    
            // Formatear fechas en cada subtarea
            $tarea->subtareas->each(function ($subtarea) {
                if ($subtarea->fecha_inicio) {
                    $subtarea->fecha_inicio_formatted = \Carbon\Carbon::parse($subtarea->fecha_inicio)->format('d-m-Y');
                }
                if ($subtarea->fecha_limite) {
                    $subtarea->fecha_fin_formatted = \Carbon\Carbon::parse($subtarea->fecha_fin)->format('d-m-Y');
                }
            });
        });
    
        // Verificar si la vista existe y renderizarla
        if (view()->exists("tareas.{$view}")) {
            return view("tareas.{$view}", compact('tareasGenerales', 'subtareas'))->render();
        }
    
        return abort(404);
    }

    public function show($id)
{
    $task = Task::findOrFail($id);
     // Obtener la tarea general por su ID
     $tareaGeneral = TareaGeneral::with('subtareas')->findOrFail($id);
     // También puedes cargar todas las tareas generales si es necesario
     $tareasGenerales = TareaGeneral::with('subtareas')->get();
     // Pasar las tareas generales a la vista
     return view('tareas.show', compact('tareaGeneral', 'tareasGenerales','task'));
}

public function updateTarea(Request $request, $id)
{
    $subtarea = Subtarea::findOrFail($id);
    $subtarea->update([
        'fecha_inicio' => $request->input('fecha_inicio'),
        'fecha_limite' => $request->input('fecha_limite'),
        'prioridad' => $request->input('prioridad'),
        'estado' => $request->input('estado'),
    ]);

    return redirect()->back()->with('success', 'Subtarea actualizada correctamente');
}

public function update(Request $request, Subtarea $subtarea)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'prioridad' => 'nullable|in:urgent,high,low',
        'estado' => 'required|in:Pendiente,En progreso,Completada',
    ]);

    $subtarea->update([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_limite' => $request->fecha_fin,
        'prioridad' => $request->prioridad,
        'estado' => $request->estado,
    ]);

    return redirect()->route('tareas')->with('success', 'Subtarea actualizada exitosamente.');
}

public function destroy($id)
{
    $user = Auth::user();

    // Buscar subtarea por ID y verificar que pertenece a una tarea general del usuario
    $subtarea = Subtarea::where('user_id', $user->id)->findOrFail($id);

    $subtarea->delete();

    return redirect()->route('tareas')->with('success', 'Subtarea eliminada exitosamente.');
}
public function guardarCambios(Request $request, $id)
{
    $request->validate([
        'estado' => 'in:Pendiente,En progreso,Completada',
    ]);
    $subtarea = Subtarea::findOrFail($id);
    if($request->estado){
        $subtarea->update([
            'estado' => $request->estado,
        ]);
    }
    if($request->fecha_limite){
        $subtarea->update([
            'fecha_limite' => $request->fecha_limite,
        ]);
    }
    if($request->fecha_inicio){
        $subtarea->update([
            'fecha_inicio' => $request->fecha_inicio,
        ]);
    }
    if($request->prioridad){
        $subtarea->update([
            'prioridad' => $request->prioridad,
        ]);
    }
    return redirect()->route('tareas')->with('success', 'Tarea modificada con éxito');
    
}
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Pendiente,En progreso,Completada',
    ]);

    $subtarea = Subtarea::findOrFail($id);

    $subtarea->update([
        'estado' => $request->status,
    ]);

    return redirect()->route('tareas')->with('success', 'Estado de la subtarea actualizado.');
}

     // Función para la vista de calendario
     public function calendario()
     {
         return view('tareas.calendario');
     }
 
     // Función para devolver tareas en formato JSON
     public function obtenerTareasJson()
     {
         $tareas = Task::all(); // Si usas paginación o filtros, puedes ajustar esto
         $eventos = [];
 
         foreach ($tareas as $tarea) {
             $eventos[] = [
                 'title' => $tarea->title,
                 'start' => $tarea->fecha_inicio, // Si tienes un campo de fecha de inicio en la DB
                 'end'   => $tarea->fecha_fin,    // Si tienes un campo de fecha de fin
                 'description' => $tarea->description,
                 'status' => $tarea->status,
             ];
         }
 
         return response()->json($eventos);
     }

     public function default(Request $request)
     {
         // Validar que se reciban las subtareas seleccionadas
         $request->validate([
             'subtareas' => 'required|array',
             'subtareas.*' => 'exists:tareas_predefinidas,id',
         ]);
     
         // Obtener el usuario autenticado
         $user = Auth::user();
     
         // Iterar sobre las subtareas seleccionadas
         foreach ($request->subtareas as $subtareaId) {
             // Buscar la tarea predefinida
             $tareaPredefinida = TareasPredefinidas::findOrFail($subtareaId);
     
             // Ajustar fechas
             $fechaInicio = \Carbon\Carbon::parse($tareaPredefinida->fecha_inicio);
             $fechaLimite = \Carbon\Carbon::parse($tareaPredefinida->fecha_limite);
     
             $hoy = \Carbon\Carbon::now();
     
             if ($fechaInicio->isPast() && $fechaInicio->isSameDay($hoy)) {
                 $fechaInicio->addYear();
             }
     
             if ($fechaLimite->isPast() && $fechaLimite->isSameDay($hoy)) {
                 $fechaLimite->addYear();
             }
     
             // Crear una nueva subtarea asociada al usuario y a la misma tarea general
             Subtarea::create([
                 'tarea_general_id' => $tareaPredefinida->tarea_general_id,
                 'user_id' => $user->id,
                 'nombre' => $tareaPredefinida->nombre,
                 'fecha_inicio' => $fechaInicio,
                 'fecha_limite' => $fechaLimite,
                 'prioridad' => $tareaPredefinida->prioridad,
             ]);
         }
     
         // Redireccionar con un mensaje de éxito
         return redirect()->route('tareas')->with('success', 'Las tareas seleccionadas se han agregado correctamente a tu tablero.');
     }
     

     public function store(Request $request)
     {
        // dd($request->all());
         $request->validate([
             'tarea_general_id' => 'required',
             'subtareas' => 'required|array',
             'subtareas.*.nombre' => 'required|string|max:255',
             'subtareas.*.fecha_inicio' => 'required|date',
             'subtareas.*.fecha_fin' => 'required|date',
             
         ]);
     
         // Validación personalizada de fechas
         foreach ($request->subtareas as $subtarea) {
             if (strtotime($subtarea['fecha_fin']) < strtotime($subtarea['fecha_inicio'])) {
                 return redirect()->back()
                     ->withErrors(['subtareas' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio en todas las subtareas.'])
                     ->withInput();
             }
         }
     
         try {
             // Crear la Tarea General
             $tareaGeneral = TareaGeneral::findOrFail($request->tarea_general_id);
     
             // Crear Subtareas asociadas
             foreach ($request->subtareas as $subtarea) {
                 $tareaGeneral->subtareas()->create([
                     'nombre' => $subtarea['nombre'],
                     'fecha_inicio' => $subtarea['fecha_inicio'],
                     'fecha_limite' => $subtarea['fecha_fin'],
                     'estado' => $subtarea['estado'],
                     'prioridad' => $subtarea['prioridad'],
                     'user_id' => Auth::id(),
                 ]);
             }
     
             // En caso de éxito
             return redirect()->route('tareas')->with('success', 'Tareas creadas exitosamente.');
         } catch (\Exception $e) {
             // Registrar el error si es necesario
             //Log::error('Error al crear la Tarea General o Subtareas: ' . $e->getMessage());
     
             // En caso de error
             return redirect()->back()
                 ->with('error', 'Ocurrió un error al crear las tareas. '.$e->getMessage())
                 ->withInput();
         }
     }

     public function search(Request $request)
     {
         $query = $request->input('q');
         if (!$query) {
             return response()->json([], 200);
         }
     
         $tareas = TareaGeneral::where('nombre', 'LIKE', '%' . $query . '%')
             ->where('user_id', Auth::id()) // Asegúrate de filtrar por usuario autenticado
             ->get(['id', 'nombre']); // Selecciona solo los campos necesarios
     
         return response()->json($tareas);
     }
     

        



}