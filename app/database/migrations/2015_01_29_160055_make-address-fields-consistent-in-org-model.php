<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeAddressFieldsConsistentInOrgModel extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organizations', function($table)
        {
            $table->dropColumn('address');
            $table->string('address1',150)->nullable()->after('url');
            $table->string('address2',150)->nullable()->after('address1');
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
            $table->string('address',150)->nullable()->after('url');
            $table->dropColumn('address1');
            $table->dropColumn('address2');
        });
    }

}
