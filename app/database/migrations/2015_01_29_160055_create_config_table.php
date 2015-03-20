<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configs', function($table)
		{
		    $table->increments('id');
		    $table->timestamps();

		    $table->boolean('allow_cyo_project_registrations');
		    $table->boolean('show_filter_organization');
		    $table->boolean('show_filter_partner');
		    $table->boolean('show_filter_time_of_week');
		    $table->boolean('show_filter_time_of_day');
		    $table->boolean('show_agreement_page');
		    $table->boolean('allow_multiple_participants');
		    $table->boolean('collect_address');
		    $table->boolean('collect_country');
		    $table->decimal('required_payment_amount');
		    $table->boolean('allow_optional_payments');
		    $table->text('content_search');
		    $table->text('content_agreement');
		    $table->text('content_registration_form');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('configs');
	}

}
