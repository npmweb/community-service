<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CombineNameFieldsOnUser extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('display_name', 100);
        });
        DB::update("UPDATE users SET display_name = CONCAT_WS(' ',first_name,last_name);");
        Schema::table('users', function($table)
        {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->string('first_name', 45);
            $table->string('last_name', 45);
        });
        // MEH don't restore the data
        Schema::table('users', function($table)
        {
            $table->dropColumn('display_name');
        });
    }

}
