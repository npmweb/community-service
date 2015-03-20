<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascadeToAttributeRelations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partner_attributes', function($table)
		{
			$table->dropForeign('partner_attributes_partner_id_foreign');
			$table->dropForeign('partner_attributes_attribute_id_foreign');
			$table->dropForeign('partner_attributes_attribute_value_id_foreign');
		});
		Schema::table('partner_attributes', function($table)
		{
		    $table->foreign('partner_id')
		    	->references('id')->on('partners')
		    	->onDelete('cascade');
		    $table->foreign('attribute_id')
		    	->references('id')->on('attributes')
		    	->onDelete('cascade');
		    $table->foreign('attribute_value_id')
		    	->references('id')->on('attribute_values')
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
			$table->dropForeign('partner_attributes_attribute_id_foreign');
			$table->dropForeign('partner_attributes_attribute_value_id_foreign');
		});
		Schema::table('partner_attributes', function($table)
		{
		    $table->foreign('partner_id')
		    	->references('id')->on('partners');
		    $table->foreign('attribute_id')
		    	->references('id')->on('attributes');
		    $table->foreign('attribute_value_id')
		    	->references('id')->on('attribute_values');
		});
	}

}
