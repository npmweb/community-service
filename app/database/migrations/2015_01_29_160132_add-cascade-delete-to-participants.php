<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadeDeleteToParticipants extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function($table) {
            $table->dropForeign('participants_registration_id_foreign');
            $table->foreign('registration_id')
                ->references('id')->on('registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function($table) {
            $table->dropForeign('participants_registration_id_foreign');
            $table->foreign('registration_id')
                ->references('id')->on('registrations');
        });
    }

}
