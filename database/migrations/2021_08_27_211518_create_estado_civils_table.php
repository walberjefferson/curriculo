<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEstadoCivilsTable.
 */
class CreateEstadoCivilsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('estado_civil', function(Blueprint $table) {
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
		Schema::drop('estado_civil');
	}
}
