Feature: Article page
  In order to test:
  - Create Article
  - Edit Article
  - Delete Article
  - View Article
  As a variety of users
  I need to verify the Article page structure and functionality

#########################################################################################
###  VALIDATIONS
#########################################################################################

  @article @validation @api @smoke @javascript
  Scenario: Validate the structure of the Article page
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    Then I verify the structure of the Create Article page

  @article @validation @api @regression
  Scenario: Validation on Create Article
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE |
      | TITLE |       |
    And I press save and publish
    Then I am still on the Create Article page

  @article @validation @api @regression
  Scenario: Validation on Edit Article
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE      |
      | TITLE | Joe Bloggs |
    And I press save and publish
    And I verify that the article was created successfully
    And I visit the Edit Article page
    And I enter the following values on the Edit Article page
      | FIELD | VALUE |
      | TITLE |       |
    When I press save and keep published
    Then I am still on the Edit Article page


#########################################################################################
###  CREATE ARTICLE
#########################################################################################

  @article @api @regression @javascript
  Scenario: Create an Article with generic values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    Then I complete the Create Article page with generic valid data
    And I press save and publish

  @article @api @regression @javascript
  Scenario: Create an Article with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE                                 |
      | TITLE | Joe Bloggs                            |
      | BODY  | This is the body text of the Article. |
      | IMAGE | 150x350.png                           |
      | ALT   | ALT - 150x350.png                     |
    And I press save and publish
    Then I verify that the article was created successfully


#########################################################################################
###  EDIT ARTICLE
#########################################################################################

  @article @api @regression
  Scenario: Create and Edit an Article with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE      |
      | TITLE | Joe Bloggs |
    And I press save and publish
    And I verify that the article was created successfully
    Then I visit the Edit Article page
    And I enter the following values on the Edit Article page
      | FIELD | VALUE     |
      | TITLE | Sam Smith |
    And I press save and keep published
    And I verify that the article was edited successfully


#########################################################################################
###  DELETE ARTICLE
#########################################################################################

  @article @api @regression
  Scenario: Create and Delete an Article with specified values
    Given I am logged in as a user with the administrator role
    And I visit the Create Article page
    When I enter the following values on the Create Article page
      | FIELD | VALUE      |
      | TITLE | Joe Bloggs |
    And I press save and publish
    And I verify that the article was created successfully
    Then I visit the Delete Article page
    And I delete the article
    And I verify that the article was deleted successfully


