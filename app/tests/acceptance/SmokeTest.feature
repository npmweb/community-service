Feature: Smoke Test
  In order to confirm the system is coming up
  As the site owner
  I want to be able to see the home page

  Scenario: User goes to the home page
    Given I am on "/"
    Then I should see "Select Your Church"
