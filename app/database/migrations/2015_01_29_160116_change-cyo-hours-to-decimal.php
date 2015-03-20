<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCyoHoursToDecimal extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->dropColumn('num_hours');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->decimal('num_hours', 6, 2);
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
            $table->dropColumn('num_hours');
        });
        Schema::table('cyo_project_registrations', function($table)
        {
            $table->integer('num_hours');
        });
    }

}
