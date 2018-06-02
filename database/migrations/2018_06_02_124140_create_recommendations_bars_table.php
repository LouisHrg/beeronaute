<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecommendationsBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommendations_bars', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('recommendation_id')->unsigned();
            $table->foreign('recommendation_id')->references('id')->on('recommendations')->onDelete('cascade');

            $table->integer('bar_id')->unsigned();
            $table->foreign('bar_id')->references('id')->on('bars')->onDelete('cascade');

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
        Schema::dropIfExists('recommendations_bars');
    }
}
