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
        Schema::table('visitas', function (Blueprint $table) {
            // Eliminar las columnas actuales
            $table->dropColumn(['desarrollo_cria', 'calidad_reina', 'estado_nutricional', 'indice_cosecha', 'presencia_varroa']);

            // Agregar las nuevas relaciones foráneas
            $table->foreignId('desarrollo_cria_id')->nullable()->constrained('desarrollo_cria')->onDelete('set null');
            $table->foreignId('calidad_reina_id')->nullable()->constrained('calidad_reina')->onDelete('set null');
            $table->foreignId('estado_nutricional_id')->nullable()->constrained('estado_nutricional')->onDelete('set null');
            $table->foreignId('indice_cosecha_id')->nullable()->constrained('indice_cosecha')->onDelete('set null');
            $table->foreignId('presencia_varroa_id')->nullable()->constrained('presencia_varroa')->onDelete('set null');
            $table->foreignId('presencia_nosemosis_id')->nullable()->constrained('presencia_nosemosis')->onDelete('set null');
            $table->foreignId('preparacion_invernada_id')->nullable()->constrained('preparacion_invernada')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitas', function (Blueprint $table) {
            // Eliminar las nuevas columnas
            $table->dropForeign(['desarrollo_cria_id']);
            $table->dropForeign(['calidad_reina_id']);
            $table->dropForeign(['estado_nutricional_id']);
            $table->dropForeign(['indice_cosecha_id']);
            $table->dropForeign(['presencia_varroa_id']);
            $table->dropForeign(['presencia_nosemosis_id']);
            
            $table->dropColumn([
                'desarrollo_cria_id',
                'calidad_reina_id',
                'estado_nutricional_id',
                'indice_cosecha_id',
                'presencia_varroa_id',
                'presencia_nosemosis_id'
            ]);

            // Restaurar las columnas originales
            $table->string('desarrollo_cria');
            $table->string('calidad_reina');
            $table->boolean('presencia_varroa');
            $table->string('estado_nutricional');
            $table->decimal('indice_cosecha', 5, 2);
        });
    }
};
