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
			$table->string('iata', 2);
			$table->string('icao', 3);
			$table->text('callsign');
			$table->text('country');
			$table->text('alias');
			$table->string('mode', 1);
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
