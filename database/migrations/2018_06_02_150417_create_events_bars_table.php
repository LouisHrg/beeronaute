<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events_bars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('event_id')->unsigned()->nullable()->index('events_bars_event_id_foreign');
			$table->integer('bar_id')->unsigned()->nullable()->index('events_bars_bar_id_foreign');
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
		Schema::drop('events_bars');
	}

}
