<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecommendationsBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recommendations_bars', function(Blueprint $table)
		{
			$table->foreign('bar_id')->references('id')->on('bars')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('recommendation_id')->references('id')->on('recommendations')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recommendations_bars', function(Blueprint $table)
		{
			$table->dropForeign('recommendations_bars_bar_id_foreign');
			$table->dropForeign('recommendations_bars_recommendation_id_foreign');
		});
	}

}
