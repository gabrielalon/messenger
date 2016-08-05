Feature: Authentication
  In order to gain access to the posts
  As an user
  I need to be able to login and logout

  Scenario: Sign in to panel
    Given I am on "pl/login"
    When I fill in "login" with "marol"
    And I fill in "password" with "marol"
    And I press "signInSubmit"
    Then I should see "Kontakt"