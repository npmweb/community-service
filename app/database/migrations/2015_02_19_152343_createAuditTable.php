<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tx_audit', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('provider',100);
            $table->string('tx_method',255);
            $table->text('tx_request');
            $table->text('tx_response');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tx_audit');
    }

}
