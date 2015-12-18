<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use PHPUnit_Framework_Assert as Assertions;

class MyAccountContext implements Context {

  /**
   * @var HelperContext
   */
  private $helper_context;

  /**
   * @var MyAccountPage
   */
  private $my_account_page;

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct() {
    $this->my_account_page = new MyAccountPage();
  }

  /**
   * @BeforeScenario
   *
   * Allow access to the HelperContext.
   */
  public function gather_contexts(BeforeScenarioScope $scope) {
    $environment = $scope->getEnvironment();
    $this->helper_context = $environment->getContext('HelperContext');
  }

  /**
   * @Given I visit the my account page
   */
  public function visit_my_account_page() {
    $this->helper_context->visitPath($this->my_account_page->get_path());
  }

  /**
   * @Given I should be logged in successfully
   */
  public function i_should_be_logged_in_successfully() {
    $this->helper_context->iCanSeeInTheRegion('Manage', $this->my_account_page->get_region('TOOLBAR'));
    $this->helper_context->iCanSeeTheLinkInTheRegion('View', $this->my_account_page->get_region('CONTENT'));
    $this->helper_context->iCanSeeTheLinkInTheRegion('Shortcuts', $this->my_account_page->get_region('CONTENT'));
    $this->helper_context->iCanSeeInTheRegion('Edit', $this->my_account_page->get_region('CONTENT'));
    $this->helper_context->iCanSeeInTheRegion('Member for', $this->my_account_page->get_region('CONTENT'));
  }

  /**
   * @Given I verify the my account page fields and buttons are displayed on the page
   */
  public function assert_my_account_page_structure() {
    foreach ($this->my_account_page->get_all_regions() as $region) {
      $this->helper_context->minkContext->assertElementOnPage($region);
    }
  }
}

