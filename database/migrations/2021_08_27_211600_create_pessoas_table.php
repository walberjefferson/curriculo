<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePessoasTable.
 */
class CreatePessoasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pessoa', function(Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nome', 180);
            $table->date('data_nascimento');
            $table->foreignId('sexo_id')->constrained('sexo');
            $table->string('cpf', 11)->nullable();
            $table->boolean('cnh')->default(false);
            $table->string('categoria_cnh', 5)->nullable();
            $table->boolean('pcd')->default(false);
            $table->string('telefone', 15)->nullable();
            $table->string('whatsapp', 15)->nullable();
            $table->string('endereco', 120)->nullable();
            $table->string('endereco_numero', 5)->nullable();
            $table->string('complemento', 90)->nullable();
            $table->string('ponto_referencia', 80)->nullable();
            $table->string('instagram', 90)->nullable();
            $table->text('outras_informacoes')->nullable();
            $table->string('outra_habilidade', 90)->nullable();
            $table->string('foto', 100)->nullable();
            $table->foreignId('estado_id')->constrained('estado');
            $table->foreignId('cidade_id')->constrained('cidade');
            $table->foreignId('escolaridade_id')->constrained('escolaridade');
            $table->foreignId('estado_civil_id')->constrained('estado_civil');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pessoa');
	}
}
