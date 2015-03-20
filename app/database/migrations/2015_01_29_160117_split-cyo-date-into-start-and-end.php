<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SplitCyoDateIntoStartAndEnd extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropColumn('project_date');
            $table->date('start_date');
            $table->date('end_date')->nullable();
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
            $table->date('project_date');
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
        });
    }

}
