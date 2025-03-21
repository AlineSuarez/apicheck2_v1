<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    // Redirige a Google para la autenticación
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Maneja la respuesta de Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Si el usuario ya existe, solo iniciar sesión
                Auth::login($user);
                request()->session()->regenerate();
            } else {
                // Si el usuario no existe, crear uno nuevo
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), // Contraseña aleatoria
                ]);
                Auth::login($user);
            }

            return redirect()->intended('/home');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'No se pudo iniciar sesión con Google.');
        }
    }
}
