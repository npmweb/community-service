<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePartnerAttributesASimpleM2m extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partner_attributes', function($table)
		{
			$table->dropForeign('partner_attributes_attribute_id_foreign');
			$table->dropForeign('partner_attributes_partner_id_foreign');
			$table->dropUnique('partner_attributes_partner_id_attribute_id_unique');
		    $table->dropColumn('attribute_id');
		});
		Schema::table('partner_attributes', function($table)
		{
		    $table->foreign('partner_id')
		    	->references('id')->on('partners')
		    	->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('partner_attributes', function($table)
		{
			$table->dropForeign('partner_attributes_partner_id_foreign');
		    $table->integer('attribute_id')->unsigned();
		    $table->unique(['partner_id','attribute_id']);
		    $table->foreign('attribute_id')
		    	->references('id')->on('attributes')
		    	->onDelete('cascade');
		});
		Schema::table('partner_attributes', function($table)
		{
		    $table->foreign('partner_id')
		    	->references('id')->on('partners')
		    	->onDelete('cascade');
		});
	}

}
