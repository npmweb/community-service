“<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionFieldsToRegistration extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function($table) {
            $table->string('transaction_id', 50);
            $table->integer('transaction_result');
            $table->text('transaction_data');
            $table->decimal('transaction_amount', 8, 2);
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
            $table->dropColumn('transaction_id');
            $table->dropColumn('transaction_result');
            $table->dropColumn('transaction_data');
            $table->dropColumn('transaction_amount');
        });
    }

}
