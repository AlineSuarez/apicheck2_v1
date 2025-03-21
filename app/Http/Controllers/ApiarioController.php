<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Apiario;
use App\Models\Comuna;
use App\Models\Region;
use Auth;
class ApiarioController extends Controller
{
    //
        public function index()
    {
        // Smodelo Apiario
        $apiarios = Apiario::with('comuna')->where('user_id', auth()->id())->get();

        return view('apiarios.index', compact('apiarios'));
    }

    // Mostrar formulario para crear un nuevo apiario
    public function create()
    { // Obtener todas las regiones
        $regiones = Region::with('comunas')->get();
        return view('apiarios.create', compact('regiones'));

    }

    // Guardar un nuevo apiario
    public function store(Request $request)
        {
            $user_id=auth()->id();
            // Validación de datos
                // Validar los datos del formulario
            $validated = $request->validate([
                'temporada_produccion' => 'required|string|max:255',
                'registro_sag' => 'required|string|max:255',
                'num_colmenas' => 'required|integer',
                'tipo_apiario' => 'required|string|max:255',
                'tipo_manejo' => 'required|string|max:255',
                'objetivo_produccion' => 'required|string|max:255',
                'region' => 'required|integer',
                'comuna' => 'required|integer',
                'latitud' => 'required|numeric',
                'longitud' => 'required|numeric',
                'localizacion' => 'nullable|string',
                'nombre' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validación para la imagen
            ]);
            // Guardar los datos en la base de datos (incluyendo latitud y longitud)
            $comuna = Comuna::select('id', 'nombre')->where('id', $request->comuna)->first();
            $apiario = new Apiario();
            $apiario->user_id = $user_id;
            $apiario->temporada_produccion = $request->temporada_produccion;
            $apiario->registro_sag = $request->registro_sag;
            $apiario->num_colmenas = $request->num_colmenas;
            $apiario->tipo_apiario = $request->tipo_apiario;
            $apiario->tipo_manejo = $request->tipo_manejo;
            $apiario->objetivo_produccion = $request->objetivo_produccion;
            $apiario->region_id = $request->region;
            $apiario->comuna_id = $request->comuna;
            $apiario->nombre_comuna = $comuna ? $comuna->nombre : null;
            $apiario->latitud = $request->latitud;
            $apiario->longitud = $request->longitud;
            $apiario->localizacion = $request->locaxlizacion;
            $apiario->nombre = $request->nombre;
            // Manejar la carga de la imagen
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('fotos_apiarios', 'public');
                $apiario->foto = $path;
            }
            $apiario->save();



        return redirect()->route('apiarios')->with('success', 'Apiario agregado con éxito');

    }


        // Método para retornar comunas en función de la región
        public function getComunas($regionId)
        {
            $comunas = Comuna::where('region_id', $regionId)->get();
            return response()->json($comunas);
        }
        // Método para retornar comunas en función de la región
        public function deleterApiario($apiarioId)
        {
                    // Buscar el apiario por ID y verificar que pertenezca al usuario autenticado
                    $apiario = Apiario::where('id', $apiarioId)
                    ->where('user_id', auth()->id())
                    ->first(); // Usa first() para obtener una instancia del modelo

                    // Verifica si el apiario existe
                    if ($apiario) {
                        $apiario->delete(); // Elimina el apiario
                        return redirect()->route('apiarios')->with('success', 'Apiario eliminado con éxito');
                    } else {
                        // Si el apiario no existe, puedes manejar el error aquí
                        return redirect()->route('apiarios')->with('error', 'Apiario no encontrado o no autorizado para eliminar.');
                    }
        }

        public function massDelete(Request $request)
            {
                // Verifica si la solicitud contiene la lista de IDs
                $ids = $request->input('ids');
                if ($ids && is_array($ids)) {
                    // Elimina todos los apiarios con los IDs proporcionados
                    Apiario::whereIn('id', $ids)->delete();
                }

                // Puedes regresar una respuesta JSON o redirigir
                return response()->json(['success' => true]);
            }

            public function edit($id)
            {
                $apiario = Apiario::findOrFail($id);
                $regiones = Region::all();
                $comunas = Comuna::all();
                return view('apiarios.edit', compact('apiario', 'regiones','comunas'));
            }

            public function update(Request $request, $id)
            {
                $request->validate([
                    'nombre' => 'required|string|max:255',
                    'temporada_produccion' => 'required|string',
                    'registro_sag' => 'required|string',
                    'num_colmenas' => 'required|integer',
                    'tipo_apiario' => 'required|string',
                    'tipo_manejo' => 'required|string',
                    'objetivo_produccion' => 'required|string',
                    'region' => 'required|integer',
                    'comuna' => 'required|integer',
                    'latitud' => 'required|numeric',
                    'longitud' => 'required|numeric',
                    'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1048' // Validación para la imagen
                ]);

                $apiario = Apiario::findOrFail($id);

                // Verificar si se ha subido una nueva foto
                if ($request->hasFile('foto')) {
                    // Eliminar la foto anterior si existe
                    if ($apiario->foto) {
                        Storage::delete('public/' . $apiario->foto);
                    }

                    // Guardar la nueva foto
                    $path = $request->file('foto')->store('fotos_apiarios', 'public');
                    $apiario->foto = $path;
                }

                // Actualizar otros campos del apiario
                $apiario->nombre = $request->nombre;
                $apiario->temporada_produccion = $request->temporada_produccion;
                $apiario->registro_sag = $request->registro_sag;
                $apiario->num_colmenas = $request->num_colmenas;
                $apiario->tipo_apiario = $request->tipo_apiario;
                $apiario->tipo_manejo = $request->tipo_manejo;
                $apiario->objetivo_produccion = $request->objetivo_produccion;
                $apiario->region_id = $request->region;
                $apiario->comuna_id = $request->comuna;
                $apiario->latitud = $request->latitud;
                $apiario->longitud = $request->longitud;

                $apiario->save();

                return redirect()->route('apiarios')->with('success', 'Apiario actualizado exitosamente.');
            }



}
