<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionesTable extends Migration
{
    public function up()
    {
        Schema::create('regiones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('abreviatura', 10); // Ejemplo: RM para Región Metropolitana
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('regiones');
    }
}
