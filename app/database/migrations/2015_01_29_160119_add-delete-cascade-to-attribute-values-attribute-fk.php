<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascadeToAttributeValuesAttributeFk extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_values', function($table)
        {
            $table->dropForeign('attribute_values_attribute_id_foreign');
        });
        Schema::table('attribute_values', function($table)
        {
            $table->foreign('attribute_id')
                ->references('id')->on('attributes')
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
        Schema::table('attribute_values', function($table)
        {
            $table->dropForeign('attribute_values_attribute_id_foreign');
        });
        Schema::table('attribute_values', function($table)
        {
            $table->foreign('attribute_id')
                ->references('id')->on('attributes');
                // no delete cascade
        });
    }

}
