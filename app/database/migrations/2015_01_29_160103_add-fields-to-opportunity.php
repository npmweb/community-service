<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOpportunity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunities', function($table) {
            $table->text('warning_text')->nullable();
            $table->text('children_rules')->nullable();
            $table->string('external_registration_link',250)->nullable();
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
            $table->dropColumn('warning_text');
            $table->dropColumn('children_rules');
            $table->dropColumn('external_registration_link');
        });
    }

}
