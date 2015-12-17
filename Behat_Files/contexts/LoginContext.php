<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

class LoginContext implements Context {

  /**
   * @var HelperContext
   */
  private $helper_context;

  /**
   * @var PageContext
   */
  private $page_context;

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
    $this->helper_context = $environment->getContext('HelperContext');
    $this->page_context = $environment->getContext('PageContext');
  }

  /**
   * @Given I visit the Login page
   */
  public function visit_login_page() {
    $this->helper_context->visitPath($this->login_page->get_path());
  }

  /**
   * @Given I enter the username :username
   *
   * @param $username
   */
  public function fill_username_field($username) {
    $this->helper_context->getSession()
      ->getPage()
      ->fillField($this->login_page->get_field('USERNAME'), $username);
  }

  /**
   * @Given I enter the password :password
   *
   * @param $password
   */
  public function fill_password_field($password) {
    $this->helper_context->getSession()
      ->getPage()
      ->fillField($this->login_page->get_field('PASSWORD'), $password);
  }

  /**
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  function press_login_button() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->login_page->get_button('LOG_IN'));
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
   * @Given I am still on the Login page
   */
  public function i_am_still_on_the_login_page() {
    $current_url = $this->helper_context->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->login_page->get_path()) === FALSE) {
      throw new CWContextException("No longer on the Loginpage, but on {$current_url}.");
    }
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
    $this->helper_context->iCanSeeInTheRegion('Unrecognized username or password.', $this->login_page->get_message_region('LOGIN_FAILURE'));
    $this->helper_context->iCanSeeInTheRegion('Have you forgotten your password?', $this->login_page->get_message_region('LOGIN_FAILURE'));
  }

  /**
   * @Given I verify the structure of the Login page
   */
  public function i_verify_the_structure_of_the_login_page() {
    $this->page_context->verify_fields($this->login_page->get_all_fields());
    $this->page_context->verify_buttons($this->login_page->get_all_buttons());
    $this->page_context->verify_regions($this->login_page->get_all_regions());
  }
}

