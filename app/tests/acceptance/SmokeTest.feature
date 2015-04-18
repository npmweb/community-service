Feature: Smoke Test
  In order to confirm the system is coming up
  As the site owner
  I want to be able to see the home page

  Scenario: User goes to the home page
    Given there is a test church
    When I am on the homepage
    Then I should see the test church in the dropdown

  Scenario: User can see results
    Given there is a test church
    When I am on "/search/bcd"
    Then I should see service opportunities for that church
