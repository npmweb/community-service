<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardFieldsToRegistration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->string('pmt_first_name',45)->nullable();
            $table->string('pmt_last_name',45)->nullable();
            $table->string('pmt_postal_code',45)->nullable();
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
            $table->dropColumn('pmt_first_name');
            $table->dropColumn('pmt_last_name');
            $table->dropColumn('pmt_postal_code');
        });
    }

}
