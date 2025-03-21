<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserIdFromTareasGeneralesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tareas_generales', function (Blueprint $table) {
            // Eliminar la columna user_id si existe
            if (Schema::hasColumn('tareas_generales', 'user_id')) {
                $table->dropColumn('user_id'); // Eliminar la columna
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
        Schema::table('tareas_generales', function (Blueprint $table) {
            // Agregar la columna user_id nuevamente en caso de revertir
            $table->unsignedBigInteger('user_id')->nullable();

            // Restaurar la clave foránea
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }
}
