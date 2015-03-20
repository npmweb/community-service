<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partner_attributes', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('partner_id')->unsigned();
		    $table->foreign('partner_id')
		    	->references('id')->on('partners');
		    $table->integer('attribute_id')->unsigned();
		    $table->foreign('attribute_id')
		    	->references('id')->on('attributes');
		    $table->integer('attribute_value_id')->unsigned();
		    $table->foreign('attribute_value_id')
		    	->references('id')->on('attribute_values');

		    $table->unique(['partner_id','attribute_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('partner_attributes');
	}

}
