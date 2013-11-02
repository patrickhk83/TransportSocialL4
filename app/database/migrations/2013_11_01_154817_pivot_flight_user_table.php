<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotFlightUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('flight_user', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('flight_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('privacy');
			$table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('flight_user');
	}

}
