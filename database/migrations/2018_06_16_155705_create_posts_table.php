<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author')->unsigned()->index('comments_author_foreign');
			$table->text('body', 65535)->nullable();
			$table->integer('type')->unsigned();
			$table->timestamps();
			$table->integer('bar')->unsigned()->nullable()->index('comments_bar_foreign');
			$table->integer('event')->unsigned()->nullable()->index('comments_event_foreign');
			$table->integer('publication')->unsigned()->nullable()->index('comments_publication_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
