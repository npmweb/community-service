<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partners', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('organization_id')->unsigned();
		    $table->foreign('organization_id')
		    	->references('id')->on('organizations');

		    $table->string('name', 250);
		    $table->string('logo', 45);
		    $table->string('url', 250);
		    $table->text('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('partners');
	}

}
