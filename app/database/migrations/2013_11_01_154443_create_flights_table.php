<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFlightsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flights', function(Blueprint $table) {
			$table->integer('id')->unsigned()->index();
			$table->integer('number');
			$table->integer('carrier_id')->unsigned();
			$table->integer('arrival_airport_id')->unsigned();
			$table->integer('departure_airport_id')->unsigned();
			$table->datetime('arrivalTime');
			$table->datetime('departureTime');
			$table->timestamps();
		});

		Schema::table('flights', function(Blueprint $table) {
    	$table->foreign('carrier_id')->references('id')->on('airlines');
      $table->foreign('arrival_airport_id')->references('id')->on('airports');
      $table->foreign('departure_airport_id')->references('id')->on('airports');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('flights', function(Blueprint $table) {
    	$table->dropForeign('flights_carrier_id_foreign');
			$table->dropForeign('flights_arrival_airport_id_foreign');
			$table->dropForeign('flights_departure_airport_id_foreign');
		});
		Schema::drop('flights');
	}

}
