<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ApiarioController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\DashboardController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ZonificacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;


Route::get('/tareas/search', [TaskController::class, 'search'])->name('tareas.search');
Route::resource('tareas', TaskController::class);
Route::get('/tareas/view/{view}', [TaskController::class, 'loadView'])->name('tareas.view');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
// Rutas de autenticación
Auth::routes();
Route::get('login/google', [LoginController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

// Rutas para apicultores
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [ApiarioController::class, 'home'])->name('home');
    Route::resource('apiarios', ApiarioController::class);
    Route::resource('visita', VisitaController::class);
    Route::get('/visitas', [VisitaController::class, 'index'])->name('visitas.index');
    Route::get('visitas/create1/{id}', [VisitaController::class, 'primeraInspeccion'])->name('visitas.create1');
    Route::get('visitas/create/{id}', [VisitaController::class, 'create'])->name('visitas.create');
    Route::post('/apiarios/visitas1', [VisitaController::class, 'store1'])->name('visitas.store1');
    Route::post('/apiarios/visitas', [VisitaController::class, 'store'])->name('visitas.store');

Route::post('/apiarios/massDelete', [ApiarioController::class, 'massDelete'])->name('apiarios.massDelete');
});

// Redirigir a Google para autenticación
Route::get('login/google', function () {
    return Socialite::driver('google')->redirect();
});

//chatbot
//Route::resource('chatbot', ChatbotController::class);
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');
Route::get('/chatbot/messages', [ChatbotController::class, 'getMessages'])->name('chatbot.messages');
Route::get('/chatbot/consejos', [ChatbotController::class, 'generarConsejos'])->name('consejos');

// Callback después de la autenticación
Route::get('login/google/callback', function () {
    $googleUser = Socialite::driver('google')->user();

    // Aquí puedes encontrar o crear un usuario en tu base de datos
    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        // Crea un nuevo usuario si no existe
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(str_random(16)), // O usa un método diferente para generar la contraseña
        ]);
    }

    // Autentica al usuario
    Auth::login($user);

    return redirect()->intended('home'); // Cambia 'dashboard' por la ruta a la que quieras redirigir al usuario
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'home'])->name('home');


//apiarios:
// Rutas para Apiarios
Route::resource('apiarios', ApiarioController::class)->except(['show']);
Route::get('/apiarios', [ApiarioController::class, 'index'])->name('apiarios');
Route::get('apiarios/create', [ApiarioController::class, 'create'])->name('apiarios.create');
Route::post('apiarios/store', [ApiarioController::class, 'store'])->name('apiarios.store');
Route::get('apiarios/editar/{id}', [ApiarioController::class, 'edit'])->name('apiarios.edit');
Route::post('apiarios/editar/{id}', [ApiarioController::class, 'update'])->name('apiarios.editar');
Route::get('comunas/{region}', [ApiarioController::class, 'getComunas']);
Route::delete('/apiarios/delete/{apiario}', [ApiarioController::class, 'deleterApiario'])->name('apiarios.destroy');
Route::get('apiarios/{apiario}/visitas', [VisitaController::class, 'showHistorial'])->name('visitas.historial');



//Task
Route::delete('/tareas/{id}', [TaskController::class, 'destroy'])->name('tareas.destroy');
Route::get('/tareas', [TaskController::class, 'index'])->name('tareas');
Route::post('/tareas', [TaskController::class, 'store'])->name('tareas.store');
Route::post('/tareas/default', [TaskController::class, 'default'])->name('tareas.default');
Route::patch('/tareas/{id}', [TaskController::class, 'update'])->name('tareas.update');
Route::patch('/tareas/{id}/update-status', [TaskController::class, 'updateStatus']);
Route::get('/tareas/{id}', [TaskController::class, 'show'])->name('tareas.show');
Route::post('/tareas/update/{id}', [TaskController::class, 'guardarCambios']);
Route::patch('/tareas/{id}/update', [TaskController::class, 'updateTarea']);
Route::get('/tareas/calendario', [TaskController::class, 'calendario'])->name('tareas.calendario');
Route::get('/tareas/json', [TaskController::class, 'obtenerTareasJson'])->name('tareas.json');


Route::get('/visitas', [VisitaController::class, 'index'])->name('visitas');
Route::post('apiarios/{apiario}/visitas', [VisitaController::class, 'store'])->name('visitas.store');
Route::post('apiarios/{apiario}/visitas1', [VisitaController::class, 'store1'])->name('visitas.store1');

// Grupo de rutas protegidas por el middleware de autenticación y verificación de pago
Route::middleware(['auth', 'check.payment'])->group(function () {
Route::get('/zonificacion', [ZonificacionController::class, 'index'])->name('zonificacion');
//usuarios:
});
Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');
Route::patch('/user/update-name', [UserController::class, 'updateName'])->name('user.update.name');
Route::patch('/user/update-avatar', [UserController::class, 'updateAvatar'])->name('user.update.avatar');
Route::patch('/user/update-password', [UserController::class, 'updatePassword'])->name('user.update.password');
Route::post('/user/update-settings', [UserController::class, 'updateSettings'])->name('user.updateSettings');

Route::post('/user/update-plan', [UserController::class, 'updatePlan'])->name('user.updatePlan');
Route::middleware(['auth', 'check.payment'])->group(function () {
Route::get('/sistemaexperto', [ChatbotController::class, 'sistemaExpertoIndex'])->name('sistemaexperto');
});

Route::get('/generate-document/{id}', [DocumentController::class, 'generateDocument'])->name('generate.document');

Route::get('/send-email', [MailController::class, 'sendEmail']);


Route::middleware(['auth'])->group(function () {
    Route::get('/payment/initiate', [PaymentController::class, 'initiatePayment'])->name('payment.initiate');
    Route::get('/payment/response', [PaymentController::class, 'paymentResponse'])->name('payment.response');
});

// Ruta para la página de pago exitoso
Route::get('/payment/success', function () {
    return view('payment.success');
})->name('payment.success');

// Ruta para la página de pago fallido
Route::get('/payment/failed', function () {
    return view('payment.failed');
})->name('payment.failed');


Route::get('/payment/required', function () {
    return view('payment.required');
})->name('payment.required');
