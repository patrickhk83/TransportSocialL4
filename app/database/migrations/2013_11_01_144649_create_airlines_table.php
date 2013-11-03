<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAirlinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('airlines', function(Blueprint $table) {
			$table->increments('id');
			$table->text('name');
			$table->string('icao', 3);
			$table->text('callsign')->nullable();
			$table->text('country')->nullable();
			$table->text('alias')->nullable();
			$table->string('mode', 1)->nullable();
			$table->string('active', 1);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('airlines');
	}

}
