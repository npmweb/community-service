<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->integer('organization_id')->unsigned();
            $table->foreign('organization_id')
                ->references('id')->on('organizations');
            $table->integer('user_type_id')->unsigned();
            $table->foreign('user_type_id')
                ->references('id')->on('user_types');

            $table->string('username', 50);
            $table->string('password', 255);
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->string('email', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}
