<?php namespace NpmWeb\MyAppName\Models;

use NpmWeb\LaravelTest\BackendTestCase;

class OrganizationHelperTest extends BackendTestCase {

    public function setUp() {
        parent::setUp();

        require_once(app_path('src/NpmWeb/MyAppName/Helpers/Backend/OrganizationsHelper.php'));
    }

    function test_sample_org_helper_should_return_fixed_copy()
    {
        // arrange
        // nothing to do

        // act
        $output = sample_org_helper();

        // assert
        $this->assertEquals('sample org helper', $output);
    }

}
