<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityOccurrencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('opportunity_occurrences', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('opportunity_id')->unsigned();
		    $table->foreign('opportunity_id')
		    	->references('id')->on('opportunities');

		    $table->date('occurrence_date');
		    $table->time('start_time');
		    $table->time('end_time');
		    $table->integer('capacity');
		    $table->dateTime('signup_deadline');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('opportunity_occurrences');
	}

}
