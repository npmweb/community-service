<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentOrgIdField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->integer('parent_organization_id')->unsigned();
            $table->foreign('parent_organization_id')
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
        Schema::table('organizations', function($table)
        {
            $table->dropForeign('organizations_parent_organization_id_foreign');
            $table->dropColumn('parent_organization_id');
        });
    }

}
