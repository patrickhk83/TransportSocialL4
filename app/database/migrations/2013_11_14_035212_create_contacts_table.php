<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('contacts' , function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('contact_id');
			$table->string('contact_name' , 255);
			$table->integer('status')->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('contacts');
	}

}