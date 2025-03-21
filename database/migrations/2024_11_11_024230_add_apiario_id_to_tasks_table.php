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
      if (!Schema::hasColumn('tasks', 'priority')) {
         Schema::table('tasks', function (Blueprint $table) {     
            $table->unsignedBigInteger('apiario_id')->nullable()->default(null)->change();
            $table->foreign('apiario_id')->references('id')->on('apiarios')->onDelete('cascade'); // Agrega la clave foránea
          });
          }
     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        });
    }
};
