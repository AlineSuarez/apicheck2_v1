<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use OpenAI;
use App\Models\Apiario;
use App\Models\Visita;
use Auth;

class ChatbotController extends Controller
{
    protected $openai;

    public function __construct()
    {
        $this->openai = app('openai');
    }

    public function index()
    {   
        return view('chatbot::index');
    }

public function send(Request $request)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $user = auth()->user();

    // Obtener los apiarios y visitas del usuario
    $apiarios = Apiario::with('comuna')
        ->where('user_id', $user->id)
        ->get(['id', 'nombre', 'localizacion', 'num_colmenas']);

    $visitas = Visita::whereHas('apiario', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })
    ->latest('fecha_visita') // Ordenar por las visitas más recientes
    ->take(10) // Limitar a las 10 visitas más recientes
    ->get(['apiario_id', 'fecha_visita', 'vigor_de_colmena', 'actividad_colmena', 'ingreso_pollen', 'reserva_alimento']);

    $messageContent = $request->message;

    // Validar relevancia del mensaje
    $keywords = [
        'abejas', 'apiario', 'colmena', 'miel', 'reina', 'enjambre', 'apicultor',
        'propóleos', 'cera', 'varroa', 'zángano', 'nectar', 'panal', 'abeja',
        'registro', 'manejo', 'sanitario', 'colmenas', 'control', 'apícola',
        'floración', 'flores', 'agrícola'
    ];

    $isRelevant = collect($keywords)->contains(function ($keyword) use ($messageContent) {
        return stripos($messageContent, $keyword) !== false;
    });

    if (!$isRelevant) {
        return response()->json([
            'user_message' => $messageContent,
            'assistant_message' => 'Lo siento, no detecté que la consulta esté relacionada con el contexto apícola. Intenta ser más claro y específico.'
        ]);
    }

    // Resumir y estructurar la información del usuario

    // Clasificar la intención del mensaje
    $intent = $this->classifyIntent($messageContent);

    // Construir el contexto basado en la intención
    $context = [
        'user' => [
            'name' => $user->name,
            'id' => $user->id,
        ],
    ];

    switch ($intent) {
        case 'historical_data':
            $visitas = Visita::whereHas('apiario', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest('fecha_visita')
            ->take(10)
            ->get(['apiario_id', 'fecha_visita', 'vigor_de_colmena',
             'actividad_colmena','bloqueo_camara_cria','presencia_celdas_reales',
             'ingreso_pollen','reserva_alimento','presencia_varroa','estado_de_cria',
             'postura_zanganos','postura_de_reina']);

            $context['visitas'] = $visitas->map(function ($visita) {
                return [
                    'fecha_visita' => $visita->fecha_visita,
                    'vigor_de_colmena' => $visita->vigor_de_colmena,
                    'actividad_colmena' => $visita->actividad_colmena,
                    'bloqueo_camara_cria'=>$visita->bloqueo_camara_cria,
                    'presencia_celdas_reales' =>$visita->presencia_celdas_reales,
                    'ingreso_pollen' => $visita->ingreso_pollen,
                    'reserva_alimento' => $visita->reserva_alimento,
                    'presencia_varroa' => $visita->presencia_varroa,
                    'postura_de_reina' => $visita->postura_de_reina,
                    'estado_de_cria' => $visita->estado_de_cria,
                    'postura_zanganos' => $visita->postura_zanganos,
                ];
            });
            break;

        case 'specific_advice':
            $context['apiarios'] = Apiario::where('user_id', $user->id)
                ->get(['nombre', 'num_colmenas']);
            $context['note'] = 'Proveer consejos basados en el manejo actual de los apiarios.';
            break;

        case 'detailed_info':
            $apiarioName = $this->extractApiarioName($messageContent); // Extraer el nombre del apiario del mensaje
            $apiario = Apiario::where('user_id', $user->id)
                ->where('nombre', 'LIKE', "%$apiarioName%")
                ->with('visitas')
                ->first();

            if ($apiario) {
                $context['apiario'] = $apiario->toArray();
            } else {
                $context['note'] =  "informacion de todos los apiarios del usuario: ".$apiario = Apiario::where('user_id', $user->id)->get();
            }
            break;

        default:
            $context['note'] = 'Ayuda general para manejo de apiarios.';
            break;
    }
    $history = $this->buildHistory($user->id);
    // Generar respuesta con OpenAI
    $response = $this->openai->chat()->create([
        'model' => 'gpt-4',
        'messages' => [
            [
                'role' => 'system',
                'content' => "Eres un asistente experto en apicultura llamado MaIA. Ayudas a apicultores a manejar sus apiarios y resolver dudas. 
                              Aquí está la información del apicultor: " . json_encode($context, JSON_PRETTY_PRINT),
            ],
            [
                'role' => 'user',
                'content' => $messageContent
            ]
        ]
    ]);

    // Guardar mensajes en la base de datos
    $message = Message::create([
        'content' => $messageContent,
        'user_id' => $user->id,
        'role' => 'user'
    ]);

    $assistantMessage = Message::create([
        'content' => $response['choices'][0]['message']['content'],
        'user_id' => $user->id,
        'role' => 'assistant'
    ]);

    return response()->json([
        'user_message' => $message,
        'assistant_message' => $assistantMessage,
    ]);
}

    public function getMessages()
    {
        $messages = Message::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
    }
    public function sistemaExpertoIndex()
    {
        $registros='';
        return view('sistemaexperto.index', compact('registros'));
    }



    private function buildHistory($userId, $limit = 10)
{
    $messages = Message::where('user_id', $userId)
        ->orderBy('created_at', 'desc')
        ->take($limit)
        ->get()
        ->reverse(); // Para mantener el orden cronológico

    return $messages->map(function ($message) {
        return [
            'role' => $message->role,
            'content' => $message->content,
        ];
    })->toArray();
}



private function classifyIntent($message)
{
    $intents = [
        'historical_data' => ['historial', 'visitas recientes', 'manejo', 'registro'],
        'specific_advice' => ['mejorar', 'control', 'varroa', 'producción', 'consejo','apiarios'],
        'detailed_info' => ['detalles', 'información', 'mi apiario', 'última visita']
    ];

    foreach ($intents as $intent => $keywords) {
        foreach ($keywords as $keyword) {
            if (stripos($message, $keyword) !== false) {
                return $intent;
            }
        }
    }

    return 'default'; // Si no coincide con ninguna intención específica
}




public function generarConsejos()
{
    $user = Auth::user();

    // Obtener información relevante de apiarios y visitas
    $apiarios = Apiario::with('comuna')->where('user_id', $user->id)->get();
    $visitas = Visita::whereHas('apiario', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->get();

    // Construir contexto para enviar a GPT
    $context = [
        'user' => [
            'name' => $user->name,
            'id' => $user->id,
        ],
        'apiarios' => $apiarios->map(function ($apiario) {
            return [
                'id' => $apiario->id,
                'nombre' => $apiario->nombre,
                'num_colmenas' => $apiario->num_colmenas,
                'localizacion' => $apiario->localizacion,
            ];
        }),
        'visitas' => $visitas->map(function ($visita) {
            return [
                'fecha_visita' => $visita->fecha_visita,
                'vigor_de_colmena' => $visita->vigor_de_colmena,
                'actividad_colmena' => $visita->actividad_colmena,
                'bloqueo_camara_cria'=>$visita->bloqueo_camara_cria,
                'presencia_celdas_reales' =>$visita->presencia_celdas_reales,
                'ingreso_pollen' => $visita->ingreso_pollen,
                'reserva_alimento' => $visita->reserva_alimento,
                'presencia_varroa' => $visita->presencia_varroa,
                'postura_de_reina' => $visita->postura_de_reina,
                'estado_de_cria' => $visita->estado_de_cria,
                'postura_zanganos' => $visita->postura_zanganos,
    
            ];
        }),
    ];
    $ejemplo = [
        'apiarios' =>[
            'id' =>'ID del Apiario',
            'nombre' =>'nombre del apiario',
            'num_colmenas' =>'numero de colmenas del apiario',
            'consejo'=>'aquí el consejo del sistema experto, según los puntos de chequeo y control registrados'
        ]
    ];

    // Solicitar a GPT consejos basados en la información
    $response = $this->openai->chat()->create([
        'model' => 'gpt-4',
        'messages' => [
            [
                'role' => 'system',
                'content' => "Eres un sistema experto en apicultura. Proporciona un JSON con consejos basados en los puntos de chequeo y los datos proporcionados. El Json devuelto debe ser tal que". json_encode($ejemplo, JSON_PRETTY_PRINT)
            ],
            [
                'role' => 'user',
                'content' => "Aquí está la información del apicultor y sus registros: " . json_encode($context, JSON_PRETTY_PRINT)
            ]
        ]
    ]);

    // Procesar respuesta
  
    $consejos = json_decode($response['choices'][0]['message']['content'], true);

    // Asegurar que el JSON tiene la estructura esperada
    if (!isset($consejos['apiarios']) || !is_array($consejos['apiarios'])) {
        $validConsejos = collect($consejos['apiarios'] ?? [])->map(function ($apiario) {
            return [
                'id' => $apiario['id'] ?? '#',
                'nombre' => $apiario['nombre'] ?? '#',
                'num_colmenas' => $apiario['num_colmenas'] ?? 0,
                'consejo' => $apiario['consejo'] ?? 'No hay consejo disponible para este apiario.',
            ];
        });
        
        return response()->json(['apiarios' => $validConsejos]);
    }
    return response()->json($consejos);
}
private function extractApiarioName($message)
{
    // Ejemplo de extracción de nombre de apiario
    preg_match('/apiario ([\w\s]+)/i', $message, $matches);
    return $matches[1] ?? null;
}
}
