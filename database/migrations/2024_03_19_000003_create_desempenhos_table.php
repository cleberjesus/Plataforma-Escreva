<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('desempenhos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_redacoes')->default(0);
            $table->decimal('media_geral', 5, 2)->default(0);
            $table->decimal('media_comp1', 5, 2)->default(0);
            $table->decimal('media_comp2', 5, 2)->default(0);
            $table->decimal('media_comp3', 5, 2)->default(0);
            $table->decimal('media_comp4', 5, 2)->default(0);
            $table->decimal('media_comp5', 5, 2)->default(0);
            $table->integer('tempo_medio')->default(0); // tempo médio em segundos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('desempenhos');
    }
}; 