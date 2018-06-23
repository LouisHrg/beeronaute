<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscriptions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('event')->unsigned()->nullable()->index('subscriptions_event_foreign');
			$table->integer('bar')->unsigned()->nullable()->index('subscriptions_bar_foreign');
			$table->smallInteger('type')->unsigned();
			$table->timestamps();
			$table->integer('user_id')->unsigned()->index('subscriptions_user_id_foreign');
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
		Schema::drop('subscriptions');
	}

}
