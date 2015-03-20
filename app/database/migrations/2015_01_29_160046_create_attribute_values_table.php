<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_values', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('attribute_id')->unsigned();
		    $table->foreign('attribute_id')
		    	->references('id')->on('attributes');

		    $table->string('value',45);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attribute_values');
	}

}
