<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunityAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('opportunity_attributes', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('opportunity_id')->unsigned();
		    $table->foreign('opportunity_id')
		    	->references('id')->on('partners');
		    $table->integer('attribute_id')->unsigned();
		    $table->foreign('attribute_id')
		    	->references('id')->on('attributes');
		    $table->integer('attribute_value_id')->unsigned();
		    $table->foreign('attribute_value_id')
		    	->references('id')->on('attribute_values');

		    $table->unique(['opportunity_id','attribute_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('opportunity_attributes');
	}

}
