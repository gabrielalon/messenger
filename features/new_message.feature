Feature: New Message
  In order to leave a message
  As a website user
  I need to be able to submit message form with data

  Scenario: Inserting message
    Given I am on "pl/message/new"
    When I fill in "message_author_name" with "testowy"
    And I fill in "message_author_phone" with "123456789"
    And I fill in "message_author_email" with "testowy@ex.pl"
    And I fill in "message_content" with "some example content"
    And I press "messageSubmit"
    Then I should see "Twoja wiadomość została zapisana"