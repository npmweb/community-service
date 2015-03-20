<?php

use NpmWeb\ServiceOpportunities\Models\AttributeValue;

class AttributeValueTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attribute_values')->delete();

        // attribute 3: Language
        AttributeValue::create([
            'id' => 22,
            'attribute_id' => 3,
            'value' => 'Yes',
        ]);
        AttributeValue::create([
            'id' => 23,
            'attribute_id' => 3,
            'value' => 'No',
        ]);

        // attribute 4: Family Friendly
        AttributeValue::create([
            'id' => 24,
            'attribute_id' => 4,
            'value' => 'Yes',
        ]);
        AttributeValue::create([
            'id' => 25,
            'attribute_id' => 4,
            'value' => 'No',
        ]);

        // attribute 4: Requires Money
        AttributeValue::create([
            'id' => 26,
            'attribute_id' => 5,
            'value' => 'Yes',
        ]);
        AttributeValue::create([
            'id' => 27,
            'attribute_id' => 5,
            'value' => 'No',
        ]);
    }

}
