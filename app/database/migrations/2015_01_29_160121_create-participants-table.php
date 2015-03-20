<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('uid',8)->unique();

            $table->integer('registration_id')->unsigned();
            $table->foreign('registration_id')
                ->references('id')->on('registrations');

            $table->string('first_name',45);
            $table->string('last_name',45);
            $table->string('email',100);
            $table->date('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('participants');
    }

}
