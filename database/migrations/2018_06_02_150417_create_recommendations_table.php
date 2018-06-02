<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecommendationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recommendations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->string('slug')->unique('lists_slug_unique');
			$table->dateTime('published');
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
		Schema::drop('recommendations');
	}

}
