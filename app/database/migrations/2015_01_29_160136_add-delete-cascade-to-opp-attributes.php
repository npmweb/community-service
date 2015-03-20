<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascadeToOppAttributes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opportunity_attributes', function($table) {
            $table->dropForeign('opportunity_attributes_attribute_value_id_foreign');
        });
        Schema::table('opportunity_attributes', function($table) {
            $table->foreign('attribute_value_id')
                ->references('id')->on('attribute_values')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opportunity_attributes', function($table) {
            $table->dropForeign('opportunity_attributes_attribute_value_id_foreign');
        });
        Schema::table('opportunity_attributes', function($table) {
            $table->foreign('attribute_value_id')
                ->references('id')->on('attribute_values');
        });
    }

}
