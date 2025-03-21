<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\Models\User;
use App\Models\Region;
use App\Models\Comuna;

class UserController extends Controller
{
    // Actualizar nombre del usuario
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Nombre actualizado correctamente.');
    }
    public function settings()
    {
        $regiones = Region::with('comunas')->get();
        $user = Auth::user();
        return view('user.settings',compact('regiones','user'));
    }
    // Actualizar avatar del usuario
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|string',
        ]);

        $user = Auth::user();
        $user->avatar = $request->avatar; // Asegúrate de tener un campo 'avatar' en tu modelo User
        $user->save();

        return redirect()->back()->with('success', 'Avatar actualizado correctamente.');
    }

    // Restablecer contraseña del usuario
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Contraseña restablecida correctamente.');
    }

    public function updateSettings(Request $request)
    {
        // Validar la solicitud
        $validated = $request->validate([
            'rut' => ['required', 'regex:/^\d{1,2}\.\d{3}\.\d{3}-[0-9Kk]{1}$/'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^\d{9}$/'],
            'id_region' => ['nullable', 'exists:regiones,id'],
            'id_comuna' => ['nullable', 'exists:comunas,id'],
            'nregistro' => ['nullable', 'string', 'max:50'],
        ]);
    
        // Buscar al usuario por su ID
        $user = Auth::user();
    
        // Completar o actualizar los datos del usuario
        $user->rut = $validated['rut'] ?? $user->rut;
        $user->name = $validated['name'] ?? $user->name;
        $user->telefono = $validated['phone'] ?? $user->telefono;
        $user->razon_social = $validated['name'] . ' ' . ($validated['last_name'] ?? '') ?? $user->razon_social;
        $user->id_region = $validated['id_region'] ?? $user->id_region;
        $user->id_comuna = $validated['id_comuna'] ?? $user->id_comuna;
        $user->numero_registro = $validated['nregistro'] ?? $user->numero_registro;
    
    
    
        // Guardar los cambios
        $user->save();
    
        return redirect()->back()->with('success', 'Información actualizada correctamente.');
    }
    

}
