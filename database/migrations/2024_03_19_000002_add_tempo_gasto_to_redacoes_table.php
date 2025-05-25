<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->integer('tempo_gasto')->nullable(); // tempo em segundos
        });
    }

    public function down()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->dropColumn('tempo_gasto');
        });
    }
}; 