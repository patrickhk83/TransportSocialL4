<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserCustomFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->string('company')->nullable();
			$table->string('phone')->nullable();
			$table->string('country')->nullable();
			$table->string('birthday')->nullable();
			$table->string('about_me')->nullable();
			$table->string('hobbies')->nullable();
			$table->string('musics')->nullable();
			$table->string('movies')->nullable();
			$table->string('books')->nullable();
			$table->integer('profile_pic')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropColumn('company');
			$table->dropColumn('phone');
			$table->dropColumn('country');
			$table->dropColumn('birthday');
			$table->dropColumn('about_me');
			$table->dropColumn('hobbies');
			$table->dropColumn('musics');
			$table->dropColumn('movies');
			$table->dropColumn('books');
			$table->dropColumn('profile_pic');
		});
	}

}
