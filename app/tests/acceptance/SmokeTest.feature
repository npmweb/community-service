Feature: Smoke Test
  In order to confirm the system is coming up
  As the site owner
  I want to be able to see the home page

  Scenario: User goes to the home page
    Given there is a test occurrence
    And I am on the homepage
    Then I should see the test church in the dropdown

  Scenario: User can see results
    Given I am on the homepage
    And I choose a church from the dropdown
    Then I should see service opportunities for that church
