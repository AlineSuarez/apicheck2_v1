<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenAI;
class ChatbotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('openai', function ($app) {
            $apiKey = config('services.openai.api_key');
            if (!$apiKey) {
                throw new \Exception('OpenAI API key is not set in the configuration.');
            }
            return OpenAI::client(config('services.openai.api_key'));
        });

    }

    public function boot()
    {
        // Verifica que las rutas existan antes de cargarlas
        if (file_exists(__DIR__.'/../routes/chatbot.php')) {
            $this->loadRoutesFrom(__DIR__.'/../routes/chatbot.php');
        }

        // Verifica que las vistas existan antes de cargarlas
        if (is_dir(__DIR__.'/../resources/views/chatbot')) {
            $this->loadViewsFrom(__DIR__.'/../resources/views/chatbot', 'chatbot');
        }

        // Publicar recursos
        $this->publishes([
            __DIR__.'/../resources/views/chatbot' => resource_path('views/vendor/chatbot'),
            __DIR__.'/../public/css' => public_path('vendor/chatbot/css'),
            __DIR__.'/../public/js' => public_path('vendor/chatbot/js'),
        ], 'chatbot');
    }
}

