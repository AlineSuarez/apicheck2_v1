<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColmenasTable extends Migration
{
    public function up()
    {
        Schema::create('colmenas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apiario_id')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->string('estado_inicial');
            $table->integer('numero_marcos');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('colmenas');
    }
}