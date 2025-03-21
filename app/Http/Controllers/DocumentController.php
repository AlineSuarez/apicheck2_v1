<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apiario;
use App\Models\Colmena;
use App\Models\User;
use App\Models\Task;
use App\Models\SubTarea;
use App\Models\Visita;
use Auth;
use proj4php\Proj4php;
use proj4php\Proj;
use proj4php\Point;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    public function generateDocument($id)
    {
        $user = Auth::user();
        $apiario = Apiario::findOrFail($id);
      // Obtener las visitas asociadas al apiario con el ID dado
        $visitas = Visita::whereHas('apiario', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();
          // Coordenadas de ejemplo
                $latitude = $apiario->latitud;
                $longitude = $apiario->longitud;

                // Inicializar Proj4php
                $proj4 = new Proj4php();

                // Definir sistemas de coordenadas
                $projWGS84 = new Proj('EPSG:4326', $proj4); // Sistema WGS84
                $projUTM = new Proj('EPSG:32719', $proj4); // Sistema UTM Zona 19 Sur (para Chile)

                // Convertir coordenadas
                $pointSource = new Point($longitude, $latitude, $projWGS84); // Longitud, Latitud
                $pointDest = $proj4->transform($projUTM, $pointSource);

                // Extraer coordenadas UTM
                $utm_x = $pointDest->x;
                $utm_y = $pointDest->y;
                $utm_huso = 19; // Huso UTM según longitud (Chile está en 19S o 18S)
        // Datos de ejemplo
        $data = [
            'last_name' => $user->last_name,
            'nombre_usuario' => $user->name,
            'address' => $user->dirección,
            'rut' => $user->rut,
            'phone' => $user->telefono,
            'region' => $user->region ? $user->region->nombre : 'No especificada',
            'commune' => $user->comuna ? $user->comuna->nombre : 'No especificada',
            'email' => $user->email,
            'legal_representative' => $user->representante_legal,
            'registration_number' => $user->numero_registro,
            'apiary_name' => $apiario->nombre,
            'apiary_number' => '#00'.$apiario->id,
            'activity' => $apiario->objetivo_produccion,
            'installation_date' => $apiario->temporada_produccion,
            'utm_x' =>  $utm_x,
            'utm_y' =>   $utm_y,
            'utm_huso' => $utm_huso,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'nomadic' => 'No',
            'hive_count' => $apiario->num_colmenas,
            'visits' => $visitas, // Aquí se incluyen las visitas
        ];



        // Renderizar la vista para el PDF
        $pdf = Pdf::loadView('documents.visit-record', compact('data'));

        // Descargar el PDF
        return $pdf->download('Cuaderno_De_Campo_Apiario_'.$apiario->nombre.'.pdf');
    }
}