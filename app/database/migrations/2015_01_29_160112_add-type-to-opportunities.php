<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToOpportunities extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunities', function($table) {
            $table->enum('type',['regular','sponsorship']);
            $table->string('sponsorship_label',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunities', function($table) {
            $table->dropColumn('type');
            $table->dropColumn('sponsorship_label');
        });
    }

}
