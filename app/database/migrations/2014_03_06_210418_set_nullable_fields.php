<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('organizations', function($table)
		{
		    $table->dropColumn('logo');
		    $table->dropColumn('url');
		    $table->dropColumn('address');
		    $table->dropColumn('city');
		    $table->dropColumn('state');
		    $table->dropColumn('postal_code');
		    $table->dropColumn('country');
		});

		Schema::table('organizations', function($table)
		{
		    $table->string('logo', 45)->nullable();
		    $table->string('url', 150)->nullable();
		    $table->string('address', 150)->nullable();
		    $table->string('city', 45)->nullable();
		    $table->string('state', 45)->nullable();
		    $table->string('postal_code', 45)->nullable();
		    $table->string('country', 45)->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('organizations', function($table)
		{
		    $table->dropColumn('logo');
		    $table->dropColumn('url');
		    $table->dropColumn('address');
		    $table->dropColumn('city');
		    $table->dropColumn('state');
		    $table->dropColumn('postal_code');
		    $table->dropColumn('country');
		});

		Schema::table('organizations', function($table)
		{
		    $table->string('logo', 45);
		    $table->string('url', 150);
		    $table->string('address', 150);
		    $table->string('city', 45);
		    $table->string('state', 45);
		    $table->string('postal_code', 45);
		    $table->string('country', 45);
		});
	}

}
