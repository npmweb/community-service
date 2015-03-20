<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCyoProjectRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cyo_project_registrations', function($table)
		{
		    $table->increments('id');
		    $table->string('uid',8)->unique();
		    $table->timestamps();

		    $table->integer('organization_id')->unsigned();
		    $table->foreign('organization_id')
		    	->references('id')->on('organizations');

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
		    $table->text('description');
		    $table->integer('num_hours');
		    $table->integer('num_participants');
		    $table->date('project_date');
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
		Schema::drop('cyo_project_registrations');
	}

}
