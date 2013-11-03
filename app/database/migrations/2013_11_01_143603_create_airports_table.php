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
			$table->text('country');
			$table->text('city');
			$table->string('iata', 3)->nullable();
			$table->string('icao', 4)->nullable();
			$table->double('x')->nullable();
			$table->double('y')->nullable();
			$table->integer('elevation')->nullable();
			$table->float('timezone')->nullable();
			$table->string('dst', 1)->nullable();
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
