<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToSubtareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subtareas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('prioridad'); // Añadir columna
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Definir clave foránea
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
            $table->dropForeign(['user_id']); // Eliminar clave foránea
            $table->dropColumn('user_id'); // Eliminar columna
        });
    }
}
