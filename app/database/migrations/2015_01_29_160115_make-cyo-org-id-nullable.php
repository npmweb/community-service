<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCyoOrgIdNullable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropForeign('cyo_project_registrations_organization_id_foreign');
            $table->dropColumn('organization_id');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->integer('organization_id')->unsigned()->nullable();
            $table->foreign('organization_id')
                ->references('id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropForeign('cyo_project_registrations_organization_id_foreign');
            $table->dropColumn('organization_id');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->integer('organization_id')->unsigned();
            $table->foreign('organization_id')
                ->references('id')->on('organizations');
        });
    }

}
