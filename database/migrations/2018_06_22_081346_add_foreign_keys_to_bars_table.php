<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bars', function(Blueprint $table)
		{
			$table->foreign('manager')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('mood')->references('id')->on('moods')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('place')->references('id')->on('places')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bars', function(Blueprint $table)
		{
			$table->dropForeign('bars_manager_foreign');
			$table->dropForeign('bars_mood_foreign');
			$table->dropForeign('bars_place_foreign');
		});
	}

}
