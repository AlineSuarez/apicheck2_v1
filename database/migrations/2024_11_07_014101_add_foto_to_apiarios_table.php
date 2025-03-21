<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('apiarios', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('longitud'); // Columna opcional para la ruta de la imagen
        });
    }
    
    public function down()
    {
        Schema::table('apiarios', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
