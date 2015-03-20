<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpportunitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('opportunities', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->integer('partner_id')->unsigned();
		    $table->foreign('partner_id')
		    	->references('id')->on('partners');

		    $table->string('name', 250);
		    $table->text('description');
		    $table->text('notes');
		    $table->string('contact_phone', 45);
		    $table->string('contact_email', 250);
		    $table->string('contact_person', 250);
		    $table->string('from_email', 250);
		    $table->text('email_template');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('opportunities');
	}

}
