<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUidToUsers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_types', function($table)
        {
            $table->string('uid',8)->unique();
        });
        Schema::table('users', function($table)
        {
            $table->string('uid',8)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_types', function($table)
        {
            $table->dropUnique('user_types_uid_unique');
            $table->dropColumn('uid');
        });
        Schema::table('users', function($table)
        {
            $table->dropUnique('users_uid_unique');
            $table->dropColumn('uid');
        });
    }

}
