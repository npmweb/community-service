<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampaignBeneficiariesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_beneficiaries', function($table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->integer('campaign_id')->unsigned();
            $table->foreign('campaign_id')
                ->references('id')->on('campaigns');
            $table->integer('beneficiary_id')->unsigned();
            $table->foreign('beneficiary_id')
                ->references('id')->on('beneficiaries')
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
        Schema::drop('campaign_beneficiaries');
    }

}
