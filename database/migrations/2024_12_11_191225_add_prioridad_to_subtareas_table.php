<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrioridadToSubtareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subtareas', function (Blueprint $table) {
            $table->enum('prioridad', ['no-prioritaria', 'baja', 'media', 'alta', 'urgente'])
                ->default('no-prioritaria')
                ->after('estado'); // Ajusta el orden si lo necesitas
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subtareas', function (Blueprint $table) {
            $table->dropColumn('prioridad');
        });
    }
}
