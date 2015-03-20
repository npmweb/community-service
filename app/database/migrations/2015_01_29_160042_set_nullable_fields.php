<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNullableFields extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partners', function($table)
        {
            $table->dropColumn('logo');
            $table->dropColumn('url');
            $table->dropColumn('description');
        });

        Schema::table('partners', function($table)
        {
            $table->string('logo', 45)->nullable();
            $table->string('url', 250)->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('opportunities', function($table)
        {
            $table->dropColumn('notes');
            $table->dropColumn('contact_phone');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_person');
            $table->dropColumn('from_email');
            $table->dropColumn('email_template');
        });

        Schema::table('opportunities', function($table)
        {
            $table->text('notes')->nullable();
            $table->string('contact_phone', 45)->nullable();
            $table->string('contact_email', 250)->nullable();
            $table->string('contact_person', 250)->nullable();
            $table->string('from_email', 250)->nullable();
            $table->text('email_template')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partners', function($table)
        {
            $table->dropColumn('logo');
            $table->dropColumn('url');
            $table->dropColumn('description');
        });

        Schema::table('partners', function($table)
        {
            $table->string('logo', 45);
            $table->string('url', 250);
            $table->text('description');
        });

        Schema::table('opportunities', function($table)
        {
            $table->dropColumn('notes');
            $table->dropColumn('contact_phone');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_person');
            $table->dropColumn('from_email');
            $table->dropColumn('email_template');
        });

        Schema::table('opportunities', function($table)
        {
            $table->text('notes');
            $table->string('contact_phone', 45);
            $table->string('contact_email', 250);
            $table->string('contact_person', 250);
            $table->string('from_email', 250);
            $table->text('email_template');
        });
    }

}
