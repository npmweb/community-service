<?php

use NpmWeb\ServiceOpportunities\Models\Attribute;

class AttributeTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('attributes')->delete();

        $orgId = 2;
        Attribute::create([
            'id' => 3,
            'organization_id' => $orgId,
            'name' => 'Spanish Speaking',
            'for' => 'opportunity',
        ]);
        Attribute::create([
            'id' => 4,
            'organization_id' => $orgId,
            'name' => 'Family Friendly',
            'for' => 'opportunity',
        ]);
        Attribute::create([
            'id' => 5,
            'organization_id' => $orgId,
            'name' => 'Requires Money',
            'for' => 'opportunity',
        ]);
    }

}
