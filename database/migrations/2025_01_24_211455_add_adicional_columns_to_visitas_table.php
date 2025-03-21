<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitas', function (Blueprint $table) {
            // Verificar y agregar cada columna si no existe
            if (!Schema::hasColumn('visitas', 'tipo_visita')) {
                $table->string('tipo_visita')->nullable(); // Tipo de visita
            }

            if (!Schema::hasColumn('visitas', 'observacion_primera_visita')) {
                $table->text('observacion_primera_visita')->nullable(); // Número de colmenas totales
            }

         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
    }
};
