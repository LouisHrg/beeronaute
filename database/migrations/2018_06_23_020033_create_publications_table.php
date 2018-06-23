<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublicationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 191);
			$table->text('content', 65535);
			$table->dateTime('published');
			$table->string('slug', 191)->unique('posts_slug_unique');
			$table->integer('author')->unsigned()->index('posts_author_foreign');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('publications');
	}

}
