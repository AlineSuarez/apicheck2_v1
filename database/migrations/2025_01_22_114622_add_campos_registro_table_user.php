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
        Schema::table('users', function (Blueprint $table) {
            $table->string('razon_social')->nullable();
            $table->string('numero_registro')->nullable();
            $table->foreignId('id_region')->nullable()->constrained('regiones')->onDelete('cascade');
            $table->foreignId('id_comuna')->nullable()->constrained('comunas')->onDelete('cascade');
            $table->string('email_disponible')->nullable();
            $table->string('rut')->nullable();
            $table->string('telefono')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('razon_social');
            $table->dropColumn('numero_registro');
            $table->dropForeign(['id_region']);
            $table->dropColumn('id_region');
            $table->dropForeign(['id_comuna']);
            $table->dropColumn('id_comuna');
            $table->dropColumn('email_disponible');
            $table->dropColumn('rut');
            $table->dropColumn('telefono');
        });
    }
};
