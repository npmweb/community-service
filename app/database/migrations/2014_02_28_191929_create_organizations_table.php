<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organizations', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->string('name', 150);
		    $table->string('logo', 45);
		    $table->string('url', 150);
		    $table->string('address', 150);
		    $table->string('city', 45);
		    $table->string('state', 45);
		    $table->string('postal_code', 45);
		    $table->string('country', 45);
		    $table->string('short_code', 45);
		    $table->string('email', 150);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('organizations');
	}

}
