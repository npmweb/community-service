<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRegAgeNullable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->dropColumn('age');
        });
        Schema::table('registrations', function($table) {
            $table->enum('age',['0-12','13+'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function($table) {
            $table->dropColumn('age');
        });
        Schema::table('registrations', function($table) {
            $table->enum('age',['0-12','13+']);
        });
    }

}
