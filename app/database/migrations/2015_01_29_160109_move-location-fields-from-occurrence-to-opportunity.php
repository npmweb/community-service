<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveLocationFieldsFromOccurrenceToOpportunity extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_occurrences', function($table) {
            $table->dropColumn('location_name');
            $table->dropColumn('location_address1');
            $table->dropColumn('location_address2');
            $table->dropColumn('location_city');
            $table->dropColumn('location_state');
            $table->dropColumn('location_postal_code');
            $table->dropColumn('location_country');
            $table->dropColumn('location_driving_instructions');
            $table->dropColumn('location_parking_instructions');
            $table->dropColumn('location_special_instructions');
        });
        Schema::table('opportunities', function($table) {
            $table->string('location_name', 100)->nullable();
            $table->string('location_address1', 150)->nullable();
            $table->string('location_address2', 150)->nullable();
            $table->string('location_city', 45)->nullable();
            $table->string('location_state', 45)->nullable();
            $table->string('location_postal_code', 45)->nullable();
            $table->string('location_country',45)->nullable()->after('location_postal_code');
            $table->text('location_driving_instructions')->nullable();
            $table->text('location_parking_instructions')->nullable();
            $table->text('location_special_instructions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunities', function($table) {
            $table->dropColumn('location_name');
            $table->dropColumn('location_address1');
            $table->dropColumn('location_address2');
            $table->dropColumn('location_city');
            $table->dropColumn('location_state');
            $table->dropColumn('location_postal_code');
            $table->dropColumn('location_country');
            $table->dropColumn('location_driving_instructions');
            $table->dropColumn('location_parking_instructions');
            $table->dropColumn('location_special_instructions');
        });
        Schema::table('opportunity_occurrences', function($table) {
            $table->string('location_name', 100)->nullable();
            $table->string('location_address1', 150)->nullable();
            $table->string('location_address2', 150)->nullable();
            $table->string('location_city', 45)->nullable();
            $table->string('location_state', 45)->nullable();
            $table->string('location_postal_code', 45)->nullable();
            $table->string('location_country',45)->nullable()->after('location_postal_code');
            $table->text('location_driving_instructions')->nullable();
            $table->text('location_parking_instructions')->nullable();
            $table->text('location_special_instructions')->nullable();
        });
    }

}
