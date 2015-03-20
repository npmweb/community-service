<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNumParticipantsFieldType extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->dropColumn('num_participants');
        });
        Schema::table('registrations', function($table) {
            $table->integer('num_participants')->unsigned()->after('email');
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
            $table->dropColumn('num_participants');
        });
        Schema::table('registrations', function($table) {
            $table->integer('num_participants')->unsigned()->after('email');
        });
    }

}
