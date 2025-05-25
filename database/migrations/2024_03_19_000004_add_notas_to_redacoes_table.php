<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->decimal('nota_comp1', 5, 1)->nullable();
            $table->decimal('nota_comp2', 5, 1)->nullable();
            $table->decimal('nota_comp3', 5, 1)->nullable();
            $table->decimal('nota_comp4', 5, 1)->nullable();
            $table->decimal('nota_comp5', 5, 1)->nullable();
            $table->decimal('nota_total', 5, 1)->nullable();
            $table->text('comentario')->nullable();
            $table->boolean('corrigida')->default(false);
        });
    }

    public function down()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->dropColumn([
                'nota_comp1',
                'nota_comp2',
                'nota_comp3',
                'nota_comp4',
                'nota_comp5',
                'nota_total',
                'comentario',
                'corrigida'
            ]);
        });
    }
}; 