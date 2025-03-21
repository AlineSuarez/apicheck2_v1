<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMail;

class MailController extends Controller
{
    public function sendEmail()
    {
        $details = [
            'title' => 'Correo de Prueba',
            'body' => 'Este es un correo de prueba desde Maia.'
        ];

        Mail::to('hernandezarancibiac@gmail.com')->send(new NotificationMail($details));

        return response()->json(['message' => 'Correo enviado con éxito.']);
    }
}
