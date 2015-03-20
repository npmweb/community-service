<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCampaignOpportunitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('campaign_opportunities');

        Schema::table('opportunities', function($table)
        {
            $table->integer('campaign_id')->unsigned();
        });
        DB::update('UPDATE opportunities SET campaign_id = 4');
        Schema::table('opportunities', function($table)
        {
            $table->foreign('campaign_id')
                ->references('id')->on('campaigns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('campaign_opportunities', function($table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->integer('campaign_id')->unsigned();
            $table->foreign('campaign_id')
                ->references('id')->on('campaigns');
            $table->integer('opportunity_id')->unsigned();
            $table->foreign('opportunity_id')
                ->references('id')->on('opportunities')
                ->onDelete('cascade');
        });

        Schema::table('opportunities', function($table)
        {
            $table->dropForeign('opportunities_campaign_id_foreign');
            $table->dropColumn('campaign_id');
        });
    }

}
