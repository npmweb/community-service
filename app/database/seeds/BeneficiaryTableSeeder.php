<?php

use NpmWeb\ServiceOpportunities\Models\Beneficiary;

class BeneficiaryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('beneficiaries')->delete();

        $p = Beneficiary::create([
            'id' => 1,
            'uid' => 'LFVRVTDL',
            'organization_id' => 2,
            'name' => 'Some Beneficiary',
            'logo' => 'somepartner.jif',
            'url' => 'http://somepartner.org',
            'description' => 'We help people.'
        ]);
        $p->campaigns()->sync([1,2,3,4,5]);
        $p->attributeValues()->sync([1]);

        $p = Beneficiary::create([
            'id' => 2,
            'uid' => '6XRYXATC',
            'organization_id' => 2,
            'name' => 'Another Beneficiary',
            'logo' => 'anotherpartner.jif',
            'url' => 'http://anotherpartner.org',
            'description' => 'We help people too.'
        ]);
        $p->attributeValues()->sync([2]);
        $p->campaigns()->sync([2,4,5]);

        $p = Beneficiary::create([
            'id' => 3,
            'uid' => '6XRYXATC',
            'organization_id' => 4,
            'name' => 'Unrelated Beneficiary',
            'logo' => 'anotherpartner.jif',
            'url' => 'http://anotherpartner.org',
            'description' => 'We help people too.'
        ]);
        $p->attributeValues()->sync([2]);
        $p->campaigns()->sync([2,3]);
    }

}
