<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cronograma_atividades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cronograma_id')->constrained()->onDelete('cascade');
            $table->date('data'); // Dia que o usuário marcou
            $table->boolean('concluido')->default(false); // Se marcou como feito ou não
            $table->timestamps();

            $table->unique(['cronograma_id', 'data']); // Impede duplicação de data no mesmo cronograma
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cronograma_atividades');
    }
};
