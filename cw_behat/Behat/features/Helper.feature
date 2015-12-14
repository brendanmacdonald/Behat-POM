Feature: Helper Feature
  In order to test any drupal site
  As an anonymous
  I need to run some basic sanity tests across the site


######################################################
###   ANONYMOUS USER
######################################################

  @roles @api @regression @smoke
  Scenario: Verify Anonymous User access to the homepage
    Given I am not logged in
    Then I check the HTTP response code is "200" for "/"

  @roles @api @regression
  Scenario: Verify Anonymous User access to /user/login
    Given I am not logged in
    Then I check the HTTP response code is "200" for "/user/login"

  @roles @api @regression
  Scenario: Verify Anonymous User access to /node/add
    Given I am not logged in
    Then I check the HTTP response code is "403" for "/node/add"

  @roles @api @regression
  Scenario: Verify Anonymous User access to /admin
    Given I am not logged in
    Then I check the HTTP response code is "403" for "/admin"

  @roles @api @regression
  Scenario: Verify Anonymous User access /user/logout
    Given I am not logged in
    Then I check the HTTP response code is "403" for "/user/logout"
