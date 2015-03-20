<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSourceFields extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function($table)
        {
            $table->dropColumn('source');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropColumn('source');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function($table)
        {
            $table->string('source',50);
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->string('source',50);
        });
    }

}
