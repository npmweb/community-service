<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHideFlagsToOrganization extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table) {
            $table->boolean('hide_in_universal_selector')->default(false);
            $table->boolean('hide_on_impacts_page')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organizations', function($table) {
            $table->dropColumn('hide_in_universal_selector');
            $table->dropColumn('hide_on_impacts_page');
        });
    }

}
