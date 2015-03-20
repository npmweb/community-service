<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeOpportunityAttributesASimpleM2m extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('opportunity_attributes', function($table)
		{
			$table->dropForeign('opportunity_attributes_attribute_id_foreign');
			$table->dropForeign('opportunity_attributes_opportunity_id_foreign');
			$table->dropUnique('opportunity_attributes_opportunity_id_attribute_id_unique');
		    $table->dropColumn('attribute_id');
		});
		Schema::table('opportunity_attributes', function($table)
		{
		    $table->foreign('opportunity_id')
		    	->references('id')->on('opportunities')
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
		Schema::table('opportunity_attributes', function($table)
		{
			$table->dropForeign('opportunity_attributes_opportunity_id_foreign');
		    $table->integer('attribute_id')->unsigned();
		    $table->unique(['opportunity_id','attribute_id']);
		    $table->foreign('attribute_id')
		    	->references('id')->on('attributes')
		    	->onDelete('cascade');
		});
		Schema::table('opportunity_attributes', function($table)
		{
		    $table->foreign('opportunity_id')
		    	->references('id')->on('opportunities')
		    	->onDelete('cascade');
		});
	}

}
