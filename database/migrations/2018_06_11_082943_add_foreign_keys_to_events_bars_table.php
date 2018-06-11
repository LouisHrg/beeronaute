<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventsBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events_bars', function(Blueprint $table)
		{
			$table->foreign('bar_id')->references('id')->on('bars')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('event_id')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events_bars', function(Blueprint $table)
		{
			$table->dropForeign('events_bars_bar_id_foreign');
			$table->dropForeign('events_bars_event_id_foreign');
		});
	}

}
