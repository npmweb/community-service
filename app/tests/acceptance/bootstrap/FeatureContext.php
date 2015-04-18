<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Laracasts\TestDummy\Factory;
use NpmWeb\ServiceOpportunities\Models\Beneficiary;
use NpmWeb\ServiceOpportunities\Models\Campaign;
use NpmWeb\ServiceOpportunities\Models\Opportunity;
use NpmWeb\ServiceOpportunities\Models\OpportunityOccurrence;
use NpmWeb\ServiceOpportunities\Models\Organization;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {


    }

    /**
     * @static
     * @beforeSuite
     */
    public static function bootstrapLaravel()
    {
        // $unitTesting = true;
        // $testEnvironment = 'frontend-testing'; // TODO doesn't use same environment as web browser

        $app = require_once __DIR__ . '/../../../../bootstrap/start.php';
        $app->boot();

        Artisan::call('migrate');
        // Artisan::call('db:seed');

        Factory::$factoriesPath = base_path().'/app/tests/factories';
    }

    /**
     * @static
     * @beforeFeature
     */
    public static function clearTables()
    {
        echo 'clearing tables';

        DB::statement('SET foreign_key_checks = 0');
        DB::statement('SET UNIQUE_CHECKS=0');

        Beneficiary::truncate();
        Campaign::truncate();
        Opportunity::truncate();
        OpportunityOccurrence::truncate();
        Organization::truncate();

        DB::statement('SET foreign_key_checks = 1');
        DB::statement('SET UNIQUE_CHECKS=1');
    }

    /**
     * @Given there is a test occurrence
     */
    public function thereIsATestOccurrence()
    {
        $result = Factory::create(Campaign::class);
        $result = Factory::create(OpportunityOccurrence::class);
        // $result = Factory::create(Opportunity::class);
        var_dump($result->errors());
    }

    /**
     * @Then I should see the test church in the dropdown
     */
    public function iShouldSeeTheTestChurchInTheDropdown()
    {
        // echo $this->getSession()->getPage()->getContent();
        $this->assertPageContainsText('Test Church');
    }

    /**
     * @When I choose a church from the dropdown
     */
    public function iChooseAChurchFromTheDropdown()
    {
        $this->selectOption('opportunities-church-select','testchurch');
    }

    /**
     * @Then I should see service opportunities for that church
     */
    public function iShouldSeeServiceOpportunitiesForThatChurch()
    {
        $this->assertPageContainsText('Test Opportunity');
    }

}
