<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNotifsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('notifs', function(Blueprint $table)
		{
			$table->foreign('bar')->references('id')->on('bars')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('event')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('recipient')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('notifs', function(Blueprint $table)
		{
			$table->dropForeign('notifs_bar_foreign');
			$table->dropForeign('notifs_event_foreign');
			$table->dropForeign('notifs_recipient_foreign');
		});
	}

}
