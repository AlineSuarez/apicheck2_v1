<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareasPredefinidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas_predefinidas', function (Blueprint $table) {
            $table->id(); // ID primaria autoincremental
            $table->unsignedBigInteger('tarea_general_id'); // Foreign key
            $table->string('nombre'); // Nombre de la tarea predefinida
            $table->timestamps();

            // Clave foránea
            $table->foreign('tarea_general_id')
                ->references('id')
                ->on('tareas_generales')
                ->onDelete('cascade'); // Cascada en eliminación
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tareas_predefinidas');
    }
}
