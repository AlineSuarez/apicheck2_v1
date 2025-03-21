<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Validar que el plan esté presente en la solicitud
        $request->validate([
            'plan' => 'required|in:mensual,anual',
        ]);
        $user = Auth::user();
        // Obtener el plan seleccionado
        $plan = $request->input('plan');
        $transaction = new Transaction();

         // Asignar el monto correspondiente según el plan
         $amount = $plan === 'mensual' ? 8900 : 90000; // Mensual: 8.900 CLP, Anual: 90.000 CLP

        $response = $transaction->create(
            uniqid(), // Orden de compra única
            uniqid(), // Código de sesión
            $amount,
            route('payment.response') // URL de retorno
        );



        // Guardar la transacción en la base de datos
        Payment::create([
            'user_id' => $user->id,
            'transaction_id' => $response->getToken(),
            'status' => 'pending',
            'amount' => $amount,
            'plan' => $plan, // Guardamos el plan elegido
        ]);

        return redirect($response->getUrl() . '?token_ws=' . $response->getToken());
    }

    public function paymentResponse(Request $request)
    {
        $transaction = new Transaction();
        $token = $request->input('token_ws');
        $response = $transaction->commit($token);

        $payment = Payment::where('transaction_id', $token)->first();

        if ($response->isApproved()) {
            $payment->update(['status' => 'paid']);

            // Obtener el usuario y el plan
            $user = Auth::user();
            $plan = $payment->plan; // Asumimos que el plan se guardó en el pago

            // Determinar la fecha de expiración
            $fechaVencimiento = now()->addMonths($plan === 'mensual' ? 1 : 12);

            // Actualizar el usuario con el plan y la fecha de expiración
            $user->update([
                'plan' => $plan,
                'fecha_vencimiento' => $fechaVencimiento,
                'webpay_status' => 'pagado'
            ]);

            return redirect()->route('payment.success');
        } else {
            $payment->update(['status' => 'failed']);
            return redirect()->route('payment.failed');
        }
    }

}
