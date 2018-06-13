<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('author')->unsigned()->index('events_author_foreign');
			$table->text('description', 65535);
			$table->string('name');
			$table->dateTime('startDate');
			$table->dateTime('endDate');
			$table->dateTime('published');
			$table->integer('slot');
			$table->integer('bar')->unsigned()->index('events_bar_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
