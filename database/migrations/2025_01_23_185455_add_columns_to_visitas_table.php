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

            if (!Schema::hasColumn('visitas', 'num_colmenas_totales')) {
                $table->integer('num_colmenas_totales')->nullable(); // Número de colmenas totales
            }

            if (!Schema::hasColumn('visitas', 'num_colmenas_inspeccionadas')) {
                $table->integer('num_colmenas_inspeccionadas')->nullable(); // Número de colmenas inspeccionadas
            }

            if (!Schema::hasColumn('visitas', 'num_colmenas_enfermas')) {
                $table->integer('num_colmenas_enfermas')->nullable(); // Número de colmenas enfermas
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
        Schema::table('visitas', function (Blueprint $table) {
            // Eliminar las columnas si existen
            if (Schema::hasColumn('visitas', 'tipo_visita')) {
                $table->dropColumn('tipo_visita');
            }

            if (Schema::hasColumn('visitas', 'num_colmenas_totales')) {
                $table->dropColumn('num_colmenas_totales');
            }

            if (Schema::hasColumn('visitas', 'num_colmenas_inspeccionadas')) {
                $table->dropColumn('num_colmenas_inspeccionadas');
            }

            if (Schema::hasColumn('visitas', 'num_colmenas_enfermas')) {
                $table->dropColumn('num_colmenas_enfermas');
            }
        });
    }
};
