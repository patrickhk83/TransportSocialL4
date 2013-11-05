<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAirportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('airports', function(Blueprint $table) {
			$table->increments('id');
			$table->text('name');
			$table->text('city');
			$table->string('country_code', 3);
			$table->string('iata', 3)->nullable();
			$table->string('icao', 4)->nullable();
			$table->string('airport_code');
			$table->double('longitude')->nullable();
			$table->double('latitude')->nullable();
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
		Schema::drop('airports');
	}

}
