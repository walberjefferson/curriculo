<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHabilidadePessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilidade_pessoa', function (Blueprint $table) {
            $table->foreignId('pessoa_id')->constrained('pessoa');
            $table->foreignId('habilidade_id')->constrained('habilidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habilidade_pessoa');
    }
}
