<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attributes', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('organization_id')->unsigned();
		    $table->foreign('organization_id')
		    	->references('id')->on('organizations');

		    $table->string('name',45);
		    $table->enum('for',['partner','opportunity']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attributes');
	}

}
