<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visitas', function (Blueprint $table) {

            // Eliminar restricciones de clave foranea
            $foreignKeys= [
                'visitas_colmena_id_foreign',
                'visitas_desarrollo_cria_id_foreign',
                'visitas_calidad_reina_id_foreign',
                'visitas_presencia_varroa_id_foreign',
                'visitas_estado_nutricional_id_foreign',
                'visitas_indice_cosecha_id_foreign',
                'visitas_presencia_nosemosis_id_foreign',
                'visitas_preparacion_invernada_id_foreign',
            ];

            foreach ($foreignKeys as $foreignKey) {
                if (Schema::hasTable('visitas') && Schema::hasColumn('visitas', 'colmena_id')) {
                    $table->dropForeign($foreignKey);
                }
            }


            // Verificar y eliminar columnas si existen
            $columnsToDrop = [
                'colmena_id',
                'desarrollo_cria_id',
                'calidad_reina_id',
                'presencia_varroa_id',
                'estado_nutricional_id',
                'indice_cosecha_id',
                'presencia_nosemosis_id',
                'preparacion_invernada_id',
            ];
            
            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('visitas', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Agregar nuevos campos si no existen
            if (!Schema::hasColumn('visitas', 'vigor_de_colmena')) {
                $table->string('vigor_de_colmena', 100)->nullable()->comment('Nivel de vigor de la colmena');
            }
            if (!Schema::hasColumn('visitas', 'actividad_colmena')) {
                $table->string('actividad_colmena', 100)->nullable()->comment('Nivel de actividad de la colmena');
            }
            if (!Schema::hasColumn('visitas', 'ingreso_pollen')) {
                $table->string('ingreso_pollen', 100)->nullable()->comment('Cantidad de polen ingresado');
            }
            if (!Schema::hasColumn('visitas', 'bloqueo_camara_cria')) {
                $table->string('bloqueo_camara_cria', 100)->nullable()->comment('Presencia de bloqueo en cámara de cría');
            }
            if (!Schema::hasColumn('visitas', 'presencia_celdas_reales')) {
                $table->string('presencia_celdas_reales', 100)->nullable()->comment('Presencia de celdas reales');
            }
            if (!Schema::hasColumn('visitas', 'postura_de_reina')) {
                $table->string('postura_de_reina', 100)->nullable()->comment('Nivel de postura de la reina');
            }
            if (!Schema::hasColumn('visitas', 'estado_de_cria')) {
                $table->string('estado_de_cria', 100)->nullable()->comment('Estado general de la cría');
            }
            if (!Schema::hasColumn('visitas', 'postura_zanganos')) {
                $table->string('postura_zanganos', 100)->nullable()->comment('Nivel de postura de zánganos');
            }
            if (!Schema::hasColumn('visitas', 'reserva_alimento')) {
                $table->string('reserva_alimento', 100)->nullable()->comment('Nivel de reserva de alimentos');
            }
            if (!Schema::hasColumn('visitas', 'presencia_varroa')) {
                $table->string('presencia_varroa', 100)->nullable()->comment('Presencia de varroa en la colmena');
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
            // Verificar y eliminar los nuevos campos si existen
            $columnsToDrop = [
                'vigor_de_colmena',
                'actividad_colmena',
                'ingreso_pollen',
                'bloqueo_camara_cria',
                'presencia_celdas_reales',
                'postura_de_reina',
                'estado_de_cria',
                'postura_zanganos',
                'reserva_alimento',
                'presencia_varroa',
            ];

            foreach ($columnsToDrop as $column) {
                if (Schema::hasColumn('visitas', $column)) {
                    $table->dropColumn($column);
                }
            }

            // Restaurar las columnas originales si no existen
            if (!Schema::hasColumn('visitas', 'colmena_id')) {
                $table->unsignedBigInteger('colmena_id')->nullable();
            }
            if (!Schema::hasColumn('visitas', 'desarrollo_cria_id')) {
                $table->unsignedBigInteger('desarrollo_cria_id')->nullable();
            }
            if (!Schema::hasColumn('visitas', 'calidad_reina_id')) {
                $table->unsignedBigInteger('calidad_reina_id')->nullable();
            }
            if (!Schema::hasColumn('visitas', 'presencia_varroa_id')) {
                $table->unsignedBigInteger('presencia_varroa_id')->nullable();
            }
            if (!Schema::hasColumn('visitas', 'estado_nutricional_id')) {
                $table->unsignedBigInteger('estado_nutricional_id')->nullable();
            }
            if (!Schema::hasColumn('visitas', 'indice_cosecha_id')) {
                $table->unsignedBigInteger('indice_cosecha_id')->nullable();
            }
            if (!Schema::hasColumn('visitas', 'presencia_nosemosis_id')) {
                $table->unsignedBigInteger('presencia_nosemosis_id')->nullable();
            }
            if (!Schema::hasColumn('visitas', 'preparacion_invernada_id')) {
                $table->unsignedBigInteger('preparacion_invernada_id')->nullable();
            }
        });
    }
}
