<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComunasTable extends Migration
{
    public function up()
    {
        Schema::create('comunas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('region_id')->constrained('regiones')->onDelete('cascade'); // Relación con la tabla regiones
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comunas');
    }
}
