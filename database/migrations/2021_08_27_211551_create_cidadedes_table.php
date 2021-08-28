<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCidadedesTable.
 */
class CreateCidadedesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cidade', function(Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('nome', 90);
            $table->foreignId('estado_id')->constrained('estado');
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
		Schema::drop('cidade');
	}
}
