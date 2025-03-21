<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasTable extends Migration
{
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apiario_id')->constrained()->onDelete('cascade');
            $table->foreignId('colmena_id')->nullable()->constrained()->onDelete('cascade');
            $table->date('fecha_visita');
            $table->string('desarrollo_cria');
            $table->string('calidad_reina');
            $table->boolean('presencia_varroa');
            $table->string('estado_nutricional');
            $table->decimal('indice_cosecha', 5, 2);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}