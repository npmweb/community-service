<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUidToPartners extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partners', function($table)
		{
		    $table->string('uid',8)->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('partners', function($table)
		{
			$table->dropUnique('partners_uid_unique');
		    $table->dropColumn('uid');
		});
	}

}
