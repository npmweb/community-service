<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\TestDummy\Factory;
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
        Artisan::call('db:seed');

        Factory::$factoriesPath = base_path().'/app/tests/factories';
    }

    /**
     * @Given there is a test church
     */
    public function thereIsATestChurch()
    {
        Factory::create(Organization::class,['name'=>'My Test Church']);
    }

    /**
     * @Then I should see the test church in the dropdown
     */
    public function iShouldSeeTheTestChurchInTheDropdown()
    {
        // echo $this->getSession()->getPage()->getContent();
        $this->assertPageContainsText('My Test Church');
    }

    /**
     * @When I choose a church from the dropdown
     */
    public function iChooseAChurchFromTheDropdown()
    {
        $this->selectOption('opportunities-church-select','Child Church - Alpharetta, GA');
    }

    /**
     * @Then I should see service opportunities for that church
     */
    public function iShouldSeeServiceOpportunitiesForThatChurch()
    {
        echo $this->getSession()->getPage()->getContent();
        $this->assertPageContainsText('Build Tables');
    }
}
