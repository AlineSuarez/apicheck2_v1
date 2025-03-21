<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNombreToApiario extends Migration
{
 
    public function up()
    { 
        if (!Schema::hasColumn('apiarios', 'nombre')) {
            // Agregar columnas nuevas
                Schema::table('apiarios', function (Blueprint $table) {
                        $table->string('nombre')->nullable(); // Ajusta la posición según lo necesites
                        $table->string('url')->nullable(); // Ajusta la posición según lo necesites
                        $table->unsignedBigInteger('activo')->nullable(); // Ajusta la posición según lo necesites
                    });              
        
    }
       
    }

    public function down()
    {
        Schema::table('apiarios', function (Blueprint $table) {
            // Eliminar columnas en caso de reversión
            $table->dropColumn(['nombre','url','activo']);
        });
    }
}
