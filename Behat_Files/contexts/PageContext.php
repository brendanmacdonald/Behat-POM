<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use PHPUnit_Framework_Assert as Assertions;

class PageContext implements Context {

  /**
   * @var HelperContext
   */
  public $helper_context;

  /**
   * @var Page
   */
  private $page;

  /**
   * PageContext constructor.
   */
  public function __construct() {
    $this->page = new Page();
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
   * Verify the fields displayed on the screen.
   * @param $fields
   */
  protected function verify_fields($fields) {
    foreach ($fields as $field) {
      Assertions::assertTrue($this->helper_context->getSession()
        ->getPage()
        ->hasField($field), $field . ' field not found');
    }
  }

  /**
   * Verify the frames displayed on the screen.
   * @param $frames
   */
  protected function verify_frames($frames) {
    foreach ($frames as $frame) {
      Assertions::assertTrue($this->helper_context->hasFrame($frame), $frame . ' frame not found');
    }
  }

  /**
   * Verify the buttons displayed on the screen.
   * @param $buttons
   */
  protected function verify_buttons($buttons) {
    foreach ($buttons as $button) {
      Assertions::assertTrue($this->helper_context->getSession()
        ->getPage()
        ->hasButton($button), $button . ' button not found');
    }
  }

  /**
   * Verify the regions displayed on the screen.
   * @param $regions
   */
  protected function verify_regions($regions) {
    foreach ($regions as $region) {
      $this->helper_context->minkContext->assertElementOnPage($region);
    }
  }

  /**
   * Verify the links displayed on the screen.
   * @param $links
   */
  protected function verify_links($links) {
    foreach ($links as $link) {
      Assertions::assertTrue($this->helper_context->getSession()
        ->getPage()
        ->hasLink($link), $link . ' link not found');
    }
  }

  /**
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  protected function press_save_and_publish_button() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->page->get_create_button('SAVE_AND_PUBLISH'));
  }

  /**
   * @throws \Behat\Mink\Exception\ElementNotFoundException
   */
  protected function press_save_and_keep_published_button() {
    $this->helper_context->getSession()
      ->getPage()
      ->pressButton($this->page->get_edit_button('SAVE_AND_KEEP_PUBLISHED'));
  }
}

