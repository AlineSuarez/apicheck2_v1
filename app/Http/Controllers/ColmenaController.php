<?php

namespace App\Http\Controllers;

use App\Models\Apiario;
use App\Models\Colmena;
use Illuminate\Http\Request;

class ColmenaController extends Controller
{
    public function index(Apiario $apiario)
    {
        return view('colmenas.index', ['apiario' => $apiario, 'colmenas' => $apiario->colmenas]);
    }

    public function create(Apiario $apiario)
    {
        return view('colmenas.create', ['apiario' => $apiario]);
    }

    public function store(Request $request, Apiario $apiario)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'estado_inicial' => 'required|string',
            'numero_marcos' => 'required|integer',
            'observaciones' => 'nullable|string',
        ]);

        $apiario->colmenas()->create($validated);

        return redirect()->route('apiarios.show', $apiario)->with('success', 'Colmena registrada correctamente.');
    }

    public function show(Apiario $apiario, Colmena $colmena)
    {
        return view('colmenas.show', ['apiario' => $apiario, 'colmena' => $colmena]);
    }
}