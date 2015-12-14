Feature: Helper Feature
  In order to test any drupal site
  As an anonymous
  I need to run some basic sanity tests across the site


######################
###   ANONYMOUS USER
######################

  @api @regression @smoke @roles
  Scenario: Verify Anonymous User access to the homepage
    Given I am not logged in
    Then I check the HTTP response code is "200" for "/"

  @api @regression @roles
  Scenario: Verify Anonymous User access to /user/login
    Given I am not logged in
    Then I check the HTTP response code is "200" for "/user/login"

  @api @regression @roles
  Scenario: Verify Anonymous User access to /node/add
    Given I am not logged in
    Then I check the HTTP response code is "403" for "/node/add"

  @api @regression @roles
  Scenario: Verify Anonymous User access to /admin
    Given I am not logged in
    Then I check the HTTP response code is "403" for "/admin"

  @api @regression @roles
  Scenario: Verify Anonymous User access /user/logout
    Given I am not logged in
    Then I check the HTTP response code is "403" for "/user/logout"
