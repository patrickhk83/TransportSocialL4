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
			$table->string('carrierFsCode', 6);
			$table->string('arrivalAirportCode', 6);
			$table->string('departureAirportCode', 6);
			$table->datetime('arrivalTime');
			$table->datetime('departureTime');
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
		Schema::drop('flights');
	}

}
