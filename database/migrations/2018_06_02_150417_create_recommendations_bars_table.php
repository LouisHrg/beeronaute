<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecommendationsBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recommendations_bars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('recommendation_id')->unsigned()->index('recommendations_bars_recommendation_id_foreign');
			$table->integer('bar_id')->unsigned()->index('recommendations_bars_bar_id_foreign');
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
		Schema::drop('recommendations_bars');
	}

}
