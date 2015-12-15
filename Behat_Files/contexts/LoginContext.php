<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use PHPUnit_Framework_Assert as Assertions;

class LoginContext implements Context {

  /**
   * @var HelperContext
   */
  private $HelperContext;

  /**
   * @var LoginPage
   */
  private $login_page;

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct() {
    $this->login_page = new LoginPage();
  }

  /**
   * @BeforeScenario
   *
   * Allow access to the HelperContext.
   */
  public function gather_contexts(BeforeScenarioScope $scope) {
    $environment = $scope->getEnvironment();
    $this->HelperContext = $environment->getContext('HelperContext');
  }

  /**
   * @param string $username
   */
  function fill_username_field($username) {
    $this->HelperContext->getSession()
      ->getPage()
      ->fillField($this->login_page->get_field('USERNAME'), $username);
  }

  /**
   * @param string $password
   */
  function fill_password_field($password) {
    $this->HelperContext->getSession()
      ->getPage()
      ->fillField($this->login_page->get_field('PASSWORD'), $password);
  }

  /**
   */
  function press_login_button() {
    $this->HelperContext->getSession()
      ->getPage()
      ->pressButton($this->login_page->get_button('LOG_IN'));
  }

  /**
   * @Given I visit the Login page
   */
  public function visit_login_page() {
    $this->HelperContext->visitPath($this->login_page->get_path());
  }

  /**
   * @Given I enter the username :username and password :password
   *
   * @param string $username , $password
   */
  public function i_enter_a_username_and_password($username, $password) {
    self::fill_username_field($username);
    self::fill_password_field($password);
  }

  /**
   * @Given I press login
   */
  public function i_press_the_login_button() {
    self::press_login_button();
  }

  /**
   * @Given I should see the login failure message
   */
  public function i_should_see_the_login_failure_message() {
    $this->HelperContext->iCanSeeInTheRegion('Unrecognized username or password.', $this->login_page->get_message_region('LOGIN_FAILURE'));
    $this->HelperContext->iCanSeeInTheRegion('Have you forgotten your password?', $this->login_page->get_message_region('LOGIN_FAILURE'));
  }

  /**
   * @Given I verify the structure of the Login page
   */
  public function assert_login_page_structure() {
    foreach ($this->login_page->get_all_fields() as $field) {
      Assertions::assertTrue($this->HelperContext->getSession()
        ->getPage()
        ->hasField($field), $field . ' field not found');
    }
    foreach ($this->login_page->get_all_buttons() as $button) {
      Assertions::assertTrue($this->HelperContext->getSession()
        ->getPage()
        ->hasButton($button), $button . ' button not found');
    }
    foreach ($this->login_page->get_all_regions() as $region) {
      $this->HelperContext->minkContext->assertElementOnPage($region);
    }
  }
}

