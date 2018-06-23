<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('recipient')->unsigned()->index('notifs_recipient_foreign');
			$table->integer('type')->unsigned();
			$table->integer('viewed')->unsigned();
			$table->integer('bar')->unsigned()->nullable()->index('notifs_bar_foreign');
			$table->integer('event')->unsigned()->nullable()->index('notifs_event_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifs');
	}

}
