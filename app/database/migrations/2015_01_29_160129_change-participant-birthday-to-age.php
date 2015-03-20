<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeParticipantBirthdayToAge extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function($table)
        {
            $table->dropColumn('birthday');
            $table->enum('age',['0-12','13+']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function($table)
        {
            $table->dropColumn('age');
            $table->date('birthday');
        });
    }

}
