<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registrations', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('occurrence_id')->unsigned();
		    $table->foreign('occurrence_id')
		    	->references('id')->on('opportunity_occurrences');

		    $table->string('first_name',45);
		    $table->string('last_name',45);
		    $table->string('address1',45);
		    $table->string('address2',45)->nullable();
		    $table->string('city',45);
		    $table->string('state',45);
		    $table->string('postal_code',45);
		    $table->string('country',45);
		    $table->string('phone',45);
		    $table->string('email',100);
		    $table->integer('num_participants');
		    $table->string('source',50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registrations');
	}

}
