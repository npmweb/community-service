<?php namespace NpmWeb\MyAppName\Models;

use Laracasts\TestDummy\Factory;
use NpmWeb\LaravelTest\BackendTestCase;

class OrganizationTest extends BackendTestCase {

    protected $model;

    public function setUp() {
        parent::setUp();
        $this->prepareTables([Organization::class]);
        $this->model = Factory::build(Organization::class);
    }

    function test_it_should_be_valid_with_minimal_data()
    {
        $this->assertTrue($this->model->validate());
    }

    function test_it_should_require_a_name()
    {
        // arrange
        $this->model->name = null;

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_names_that_are_too_long()
    {
        // arrange
        $this->model->name = str_repeat('x', 151);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_logo_file_names_that_are_too_long()
    {
        // arrange
        $this->model->logo = str_repeat('x', 46);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_urls_that_are_too_long()
    {
        // arrange
        $this->model->url = 'http://example.com/'.str_repeat('x', 132); // 151 total

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_malformed_urls()
    {
        // arrange
        $this->model->url = 'not.a@web.site';

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_addresses_that_are_too_long()
    {
        // arrange
        $this->model->address = str_repeat('x', 151);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_cities_that_are_too_long()
    {
        // arrange
        $this->model->city = str_repeat('x', 46);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_states_that_are_too_long()
    {
        // arrange
        $this->model->state = str_repeat('x', 46);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_postal_codes_that_are_too_long()
    {
        // arrange
        $this->model->postal_code = str_repeat('x', 46);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_countries_that_are_too_long()
    {
        // arrange
        $this->model->postal_code = str_repeat('x', 46);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_require_a_permalink()
    {
        // arrange
        $this->model->permalink = null;

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_permalinks_that_are_too_long()
    {
        // arrange
        $this->model->postal_code = str_repeat('x', 46);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_special_characters_in_permalinks()
    {
        // arrange
        $models = [
            Factory::build(Organization::class, ['permalink' => 'foo!bar']),
            Factory::build(Organization::class, ['permalink' => 'foo bar']),
            Factory::build(Organization::class, ['permalink' => 'foo&bar']),
            Factory::build(Organization::class, ['permalink' => 'foo\'bar']),
        ];

        // act
        $results = array_map( function($model) {
            return $model->validate();
        }, $models);

        // assert
        array_walk( $results, function($isValid) {
            $this->assertFalse($isValid);
        });
    }

    function test_it_should_require_an_email()
    {
        // arrange
        $this->model->email = null;

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_emails_that_are_too_long()
    {
        // arrange
        $this->model->email = str_repeat('x', 151);

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_not_allow_malformed_emails()
    {
        // arrange
        $this->model->email = 'http://not.an/email';

        // act
        $isValid = $this->model->validate();

        // assert
        $this->assertFalse($isValid);
    }

    function test_it_should_return_the_name_when_stringified()
    {
        // arrange
        // nothing to do

        // act
        $modelAsString = '' . $this->model;

        // assert
        $this->assertEquals($this->model->name, $modelAsString);
    }

    function test_withWebSite_scope_should_return_correct_records()
    {
        // arrange
        Factory::create(Organization::class);
        Factory::create(Organization::class,['url'=>'http://google.com']);
        Factory::create(Organization::class,['url'=>'http://laravel.com']);

        // act
        $results = $this->model->withWebSite()->get();

        // assert
        $this->assertCount(2,$results);
    }

}
