<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateHabilidadesTable.
 */
class CreateHabilidadesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('habilidade', function(Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('codigo', 4)->nullable();
            $table->string('nome', 90);
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
		Schema::drop('habilidade');
	}
}
