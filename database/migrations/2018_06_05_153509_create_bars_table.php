<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('location', 16777215);
			$table->text('bio', 16777215);
			$table->string('phone');
			$table->string('email');
			$table->timestamps();
			$table->integer('manager')->unsigned()->index();
			$table->string('slug', 267)->unique();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bars');
	}

}
