<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apiarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Relación con usuario
            $table->string('temporada_produccion',100);
            $table->string('registro_sag')->nullable();
            $table->integer('num_colmenas')->nullable();
            $table->string('tipo_apiario')->nullable();
            $table->string('tipo_manejo')->nullable();
            $table->string('objetivo_produccion')->nullable();
            $table->string('exposicion_solar')->nullable();
            $table->string('pais')->nullable();
            $table->string('comuna')->nullable();
            $table->string('localizacion')->nullable();
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apiarios');
    }
}
