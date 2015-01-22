<?php namespace spec\NpmWeb\MyAppName\Models;

use Artisan;
use Laracasts\TestDummy\Factory;
use Prophecy\Argument;
use NpmWeb\MyAppName\Models\Organization;

class OrganizationSpec extends BaseSpec
{
    function let()
    {
        $values = Factory::build(Organization::class)->toArray();
        $this->fill($values);

        // for query tests
        Artisan::call('migrate');
        $this->clearTables(['organizations']);
        $this->resetEvents([Organization::class]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Organization::class);
    }

    function it_should_be_valid_with_minimal_data()
    {
        $this->validate()->shouldReturn(true);
    }

    function it_should_require_a_name()
    {
        // arrange
        $this->name = null;

        // act
        $isValid = $this->validate();

        // assert
        $isValid->shouldReturn(false);
    }

    function it_should_not_allow_names_that_are_too_long()
    {
        $this->name = str_repeat('x', 151);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_logo_file_names_that_are_too_long()
    {
        $this->logo = str_repeat('x', 46);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_urls_that_are_too_long()
    {
        $this->url = 'http://example.com/'.str_repeat('x', 132); // 151 total
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_malformed_urls()
    {
        $this->url = 'not.a@web.site';
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_addresses_that_are_too_long()
    {
        $this->address = str_repeat('x', 151);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_cities_that_are_too_long()
    {
        $this->city = str_repeat('x', 46);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_states_that_are_too_long()
    {
        $this->state = str_repeat('x', 46);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_postal_codes_that_are_too_long()
    {
        $this->postal_code = str_repeat('x', 46);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_countries_that_are_too_long()
    {
        $this->postal_code = str_repeat('x', 46);
        $this->validate()->shouldReturn(false);
    }

    function it_should_require_a_permalink()
    {
        $this->permalink = null;
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_permalinks_that_are_too_long()
    {
        $this->postal_code = str_repeat('x', 46);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_special_characters_in_permalinks()
    {
        $this->permalink = 'foo!bar';
        $this->validate()->shouldReturn(false);

        $this->permalink = 'foo bar';
        $this->validate()->shouldReturn(false);

        $this->permalink = 'foo&bar';
        $this->validate()->shouldReturn(false);

        $this->permalink = 'foo\'bar';
        $this->validate()->shouldReturn(false);
    }

    function it_should_require_an_email()
    {
        $this->email = null;
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_emails_that_are_too_long()
    {
        $this->email = str_repeat('x', 151);
        $this->validate()->shouldReturn(false);
    }

    function it_should_not_allow_malformed_emails()
    {
        $this->email = 'http://not.an/email';
        $this->validate()->shouldReturn(false);
    }

    function it_should_return_the_name_when_stringified()
    {
        $this->__toString()->shouldEqual($this->name);
    }

    function its_withWebSite_scope_should_return_correct_records()
    {
        Factory::create(Organization::class);
        Factory::create(Organization::class,['url'=>'http://google.com']);
        Factory::create(Organization::class,['url'=>'http://laravel.com']);

        $this->withWebSite()->get()->count()->shouldBe(2);
    }

}
