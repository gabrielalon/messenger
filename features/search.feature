Feature: Search
  In order to find messages
  As a website user
  I need to be able to search for messages

  Scenario: Search for a word that exists
    Given I am on "/pl/message/list"
    When I fill in "searchTerm" with "Ut aliquam vero"
    And I press "searchSubmit"
    Then I should see "Ut aliquam vero"