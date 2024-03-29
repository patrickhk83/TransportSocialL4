<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPhotoCustomFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('photos', function(Blueprint $table) {
			$table->dropForeign('photos_user_id_foreign');
			$table->renameColumn('user_id', 'imageable_id');
			$table->string('imageable_type');
			$table->string('type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('photos', function(Blueprint $table) {
			$table->dropColumn('imageable_type');
			$table->dropColumn('type');
			$table->renameColumn('imageable_id', 'user_id');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

}
