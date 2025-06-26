<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->integer('nota')->unsigned()->nullable();
            $table->text('feedback')->nullable();
            $table->boolean('corrigida')->default(false);
        });
    }

    public function down()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->dropColumn([
                'nota',
                'feedback',
                'corrigida'
            ]);
        });
    }
}; 