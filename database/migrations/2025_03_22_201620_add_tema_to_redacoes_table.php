<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->string('tema')->after('id'); // Ajuste 'after' para posicionar onde quiser
        });
    }
    
    public function down()
    {
        Schema::table('redacoes', function (Blueprint $table) {
            $table->dropColumn('tema');
        });
    }
    
};
