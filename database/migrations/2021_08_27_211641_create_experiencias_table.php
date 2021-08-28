<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateExperienciasTable.
 */
class CreateExperienciasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('experiencia', function(Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('cargo', 80)->nullable();
            $table->string('empresa', 90)->nullable();
            $table->string('tempo_servico', 20)->nullable();
            $table->string('saida', 7)->nullable();
            $table->foreignId('pessoa_id')->constrained('pessoa');
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
		Schema::drop('experiencia');
	}
}
