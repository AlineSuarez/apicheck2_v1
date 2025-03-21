<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::middleware(['web', 'auth'])->group(function () {
   // Route::resource('chatbot', ChatbotController::class);
    Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/send', [ChatbotController::class, 'send'])->name('chatbot.send');
    Route::get('/chatbot/messages', [ChatbotController::class, 'getMessages'])->name('chatbot.messages');
});