<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePartnersToBeneficiaries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// break relations
		Schema::table('opportunities', function($table)
		{
			$table->dropForeign('opportunities_partner_id_foreign');
		});
		Schema::table('partner_attributes', function($table)
		{
			$table->dropForeign('partner_attributes_partner_id_foreign');
		});

		// rename tables and fields
		Schema::rename('partners','beneficiaries');
		Schema::rename('partner_attributes','beneficiary_attributes');
		Schema::table('beneficiary_attributes', function($table) {
			$table->renameColumn("partner_id","beneficiary_id");
		});
		Schema::table('opportunities', function($table) {
			$table->renameColumn("partner_id","beneficiary_id");
		});
		Schema::table('attributes', function($table) {
			$table->dropColumn('for');
		});
		Schema::table('attributes', function($table) {
			$table->enum('for',['beneficiary,opportunity']);
		});
		Schema::table('configs', function($table) {
			$table->renameColumn('show_filter_partner','show_filter_beneficiary');
		});

		// remake relations
		Schema::table('opportunities', function($table) {
		    $table->foreign('beneficiary_id')
		    	->references('id')->on('beneficiaries');
		});
		Schema::table('beneficiary_attributes', function($table) {
		    $table->foreign('beneficiary_id')
		    	->references('id')->on('beneficiaries');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// break relations
		Schema::table('opportunities', function($table)
		{
			$table->dropForeign('opportunities_beneficiary_id_foreign');
		});

		// rename tables and fields
		Schema::rename('beneficiaries','partners');
		Schema::rename('beneficiary_attributes','partner_attributes');
		Schema::table('partner_attributes', function($table) {
			$table->renameColumn("beneficiary_id","partner_id");
		});
		Schema::table('opportunities', function($table) {
			$table->renameColumn("beneficiary_id","partner_id");
		});
		Schema::table('attributes', function($table) {
			$table->dropColumn('for');
		});
		Schema::table('attributes', function($table) {
			$table->enum('for',['partner,opportunity']);
		});
		Schema::table('configs', function($table) {
			$table->renameColumn('show_filter_beneficiary','show_filter_partner');
		});

		// remake relations
		Schema::table('opportunities', function($table) {
		    $table->foreign('partner_id')
		    	->references('id')->on('partners');
		});
		Schema::table('partner_attributes', function($table) {
		    $table->foreign('partner_id')
		    	->references('id')->on('partners');
		});
	}

}
