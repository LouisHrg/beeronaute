<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->foreign('author', 'comments_author_foreign')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('bar', 'comments_bar_foreign')->references('id')->on('bars')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('event', 'comments_event_foreign')->references('id')->on('events')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('publication', 'comments_publication_foreign')->references('id')->on('publications')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table)
		{
			$table->dropForeign('comments_author_foreign');
			$table->dropForeign('comments_bar_foreign');
			$table->dropForeign('comments_event_foreign');
			$table->dropForeign('comments_publication_foreign');
		});
	}

}
