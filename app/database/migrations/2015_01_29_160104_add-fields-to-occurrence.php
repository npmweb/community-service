<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOccurrence extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_occurrences', function($table) {
            $table->dropColumn('occurrence_date');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('capacity');
        });
        Schema::table('opportunity_occurrences', function($table) {
            $table->date('occurrence_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->integer('capacity')->nullable();

            $table->integer('min_participants_per_registration')->nullable();
            $table->string('location_name', 100)->nullable();
            $table->string('location_address', 150)->nullable();
            $table->string('location_city', 45)->nullable();
            $table->string('location_state', 45)->nullable();
            $table->string('location_postal_code', 45)->nullable();
            $table->text('location_driving_instructions')->nullable();
            $table->text('location_parking_instructions')->nullable();
            $table->text('location_special_instructions')->nullable();
            $table->date('sponsorship_end_date')->nullable();
            $table->integer('num_families_to_sponsor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunity_occurrences', function($table) {
            $table->dropColumn('occurrence_date');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
            $table->dropColumn('capacity');

            $table->dropColumn('min_participants_per_registration');
            $table->dropColumn('location_name');
            $table->dropColumn('location_address');
            $table->dropColumn('location_city');
            $table->dropColumn('location_state');
            $table->dropColumn('location_postal_code');
            $table->dropColumn('location_driving_instructions');
            $table->dropColumn('location_parking_instructions');
            $table->dropColumn('location_special_instructions');
            $table->dropColumn('sponsorship_end_date');
            $table->dropColumn('num_families_to_sponsor');
        });
        Schema::table('opportunity_occurrences', function($table) {
            $table->date('occurrence_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('capacity');
        });
    }

}
