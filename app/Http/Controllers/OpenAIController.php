<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importar la clase Log
use OpenAI\Client;
use OpenAI\Factory;
use OpenAI\Laravel\Facades\OpenAI; // Usa el facade proporcionado por el paquete
class OpenAIController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        try {
            // Enviar el mensaje a la API de OpenAI
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo', // Cambia por el modelo que prefieras
                'messages' => [
                    ['role' => 'user', 'content' => $request->message]
                ],
            ]);

            // Obtener la respuesta del bot
            $reply = $response['choices'][0]['message']['content'];

            return response()->json(['reply' => $reply]);

        } catch (\Exception $e) {
            // Registrar el error para depuración
            \Log::error('Error al usar OpenAI API', ['exception' => $e]);

            return response()->json([
                'error' => 'Hubo un problema al procesar tu solicitud.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}