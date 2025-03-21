<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposTareasPredefinidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tareas_predefinidas', function (Blueprint $table) {
            $table->date('fecha_inicio')->nullable()->after('nombre'); // Campo de fecha inicio
            $table->date('fecha_limite')->nullable()->after('fecha_inicio'); // Campo de fecha límite
            $table->string('prioridad')->nullable()->after('fecha_limite'); // Campo de prioridad
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tareas_predefinidas', function (Blueprint $table) {
            $table->dropColumn(['fecha_inicio', 'fecha_limite', 'prioridad']); // Eliminar los campos
        });
    }
}
