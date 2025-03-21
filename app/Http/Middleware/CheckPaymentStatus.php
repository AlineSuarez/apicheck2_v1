<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPaymentStatus
{
    /**
     * Manejar una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Verificar si el usuario está autenticado y tiene el estado de pago "pagado"
        if ($user && $user->webpay_status !== 'pagado') {
            // Redirigir a una página que indique que el pago es requerido
            return redirect()->route('payment.required')->with('error', 'Debes completar el pago para acceder a esta sección.');
        }

        return $next($request);
    }
}
