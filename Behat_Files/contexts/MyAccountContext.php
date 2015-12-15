<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use PHPUnit_Framework_Assert as Assertions;

class MyAccountContext implements Context {

  /**
   * @var HelperContext
   */
  private $HelperContext;

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
    $this->HelperContext = $environment->getContext('HelperContext');
  }

  /**
   * @Given I visit the my account page
   */
  public function visit_my_account_page() {
    $this->HelperContext->visitPath($this->my_account_page->get_path());
  }

  /**
   * @Given I should be logged in successfully
   */
  public function i_should_be_logged_in_successfully() {
    $this->HelperContext->iCanSeeInTheRegion('Manage', $this->my_account_page->get_region('TOOLBAR'));
    $this->HelperContext->iCanSeeTheLinkInTheRegion('View', $this->my_account_page->get_region('CONTENT'));
    $this->HelperContext->iCanSeeTheLinkInTheRegion('Shortcuts', $this->my_account_page->get_region('CONTENT'));
    $this->HelperContext->iCanSeeInTheRegion('Edit', $this->my_account_page->get_region('CONTENT'));
    $this->HelperContext->iCanSeeInTheRegion('Member for', $this->my_account_page->get_region('CONTENT'));
  }

  /**
   * @Given I verify the my account page fields and buttons are displayed on the page
   */
  public function assert_my_account_page_structure() {
    foreach ($this->my_account_page->get_all_regions() as $region) {
      $this->HelperContext->minkContext->assertElementOnPage($region);
    }
  }
}

