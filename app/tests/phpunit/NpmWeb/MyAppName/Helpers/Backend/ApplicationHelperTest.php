<?php namespace NpmWeb\MyAppName\Models;

use NpmWeb\LaravelTest\BackendTestCase;

class ApplicationHelperTest extends BackendTestCase {

    public function setUp() {
        parent::setUp();

        require_once(app_path('src/NpmWeb/MyAppName/Helpers/Backend/ApplicationHelper.php'));
    }

    function test_sample_app_helper_should_return_fixed_copy()
    {
        // arrange
        // nothing to do

        // act
        $output = sample_app_helper();

        // assert
        $this->assertEquals('sample app helper', $output);
    }

}
