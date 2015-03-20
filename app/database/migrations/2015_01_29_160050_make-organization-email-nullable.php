<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeOrganizationEmailNullable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('email');
        });
        Schema::table('organizations', function($table)
        {
            $table->string('email',150)->nullable();
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
            $table->dropColumn('email');
        });
        Schema::table('organizations', function($table)
        {
            $table->string('email',150);
        });
    }

}
