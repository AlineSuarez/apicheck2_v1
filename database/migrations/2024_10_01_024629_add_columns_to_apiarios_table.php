<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToApiariosTable extends Migration
{
    public function up()
    {
        Schema::table('apiarios', function (Blueprint $table) {
            // Agregar columnas nuevas
            $table->unsignedBigInteger('region_id')->nullable()->after('localizacion'); // Ajusta la posición según lo necesites
            $table->unsignedBigInteger('comuna_id')->nullable()->after('region_id');
            $table->decimal('latitud', 10, 8)->nullable()->after('comuna_id');
            $table->decimal('longitud', 11, 8)->nullable()->after('latitud');
            // Agregar claves foráneas
            $table->foreign('region_id')->references('id')->on('regiones')->onDelete('set null');
            $table->foreign('comuna_id')->references('id')->on('comunas')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('apiarios', function (Blueprint $table) {
            // Eliminar columnas en caso de reversión
            $table->dropColumn(['region_id', 'comuna_id', 'latitud', 'longitud', 'localizacion']);
        });
    }
}