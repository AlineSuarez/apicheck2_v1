<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('apiarios', function (Blueprint $table) {
            $table->renameColumn('comuna', 'nombre_comuna');
        });
    }

    public function down()
    {
        Schema::table('apiarios', function (Blueprint $table) {
            $table->renameColumn('nombre_comuna', 'comuna');
        });
    }
};