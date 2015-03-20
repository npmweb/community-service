<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function($table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('uid',8)->unique();

            $table->string('name',50);
            $table->string('permalink',50);
        });

        Schema::table('opportunities', function($table)
        {
            $table->integer('campaign_id')->unsigned();
            $table->foreign('campaign_id')
                ->references('id')->on('campaigns');
        });

        Schema::table('cyo_project_registrations', function($table)
        {
            $table->integer('campaign_id')->unsigned();
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
        Schema::table('opportunities', function($table)
        {
            $table->dropForeign('opportunities_campaign_id_foreign');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropForeign('cyo_project_registrations_campaign_id_foreign');
        });

        Schema::drop('campaigns');
    }

}
