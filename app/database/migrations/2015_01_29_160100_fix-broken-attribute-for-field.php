<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixBrokenAttributeForField extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes', function($table) {
            $table->dropColumn('for');
        });
        Schema::table('attributes', function($table) {
            $table->enum('for',['beneficiary','opportunity']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes', function($table) {
            $table->dropColumn('for');
        });
        Schema::table('attributes', function($table) {
            $table->enum('for',['beneficiary,opportunity']);
        });
    }

}
