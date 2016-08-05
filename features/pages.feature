Feature: Visit pages and see contents

  Scenario: I visit home page and see welcome message
    Given I am on "/"
    Then I should see "Witaj"

  Scenario: I visit contact page and see form to leave message
    Given I am on "/pl/message/new"
    Then I should see "Nowa wiadomość"

  Scenario: I visit messages page and see list of messages
    Given I am on "/pl/message/list"
    Then I should see "Poprzednia"