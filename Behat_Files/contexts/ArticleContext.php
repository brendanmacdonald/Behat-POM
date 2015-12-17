<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as Assertions;

class ArticleContext implements Context {

  /**
   * @var HelperContext
   */
  private $HelperContext;

  /**
   * @var ArticlePage
   */
  private $article_page;

  /**
   * @var $string
   */
  private $article_page_title;

  /**
   * @var $integer
   */
  private $article_node_id;

  /**
   * Initializes context.
   *
   * Every scenario gets its own context instance.
   * You can also pass arbitrary arguments to the
   * context constructor through behat.yml.
   */
  public function __construct() {
    $this->article_page = new ArticlePage();
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
   * @Given I complete the Create Article page with generic valid data
   *
   * @param string $username , $password
   */
  public function fill_in_article_content_with_generic_valid_data() {
    self::fill_title_field('Article Title <alpha>');
    self::fill_body_frame('This is some body text.');
  }

  /**
   * @param string $title
   */
  public function fill_title_field($title) {
    $this->HelperContext->iFillInFieldByIDWith($this->article_page->get_field('TITLE'), $title);
    $this->article_page_title = $title;
  }

  /**
   * @param string $body
   */
  public function fill_body_frame($body) {
    $this->HelperContext->iFillInFrameWith($this->article_page->get_frame('BODY'), $body);
  }

  /**
   * @param string $image
   */
  public function attach_image($image) {
    $this->HelperContext->minkContext->attachFileToField($this->article_page->get_field('IMAGE'), $image);
    $this->HelperContext->waitForJquery();
  }

  /**
   * @param string $alt
   */
  public function fill_alt_field($alt) {
    $this->HelperContext->iFillInFieldByDataDrupalSelectorWith($this->article_page->get_hidden_field('ALT'), $alt);
  }

  /**
   * @Given I press save and publish
   */
  public function press_save_and_publish_button() {
    $this->HelperContext->getSession()
      ->getPage()
      ->pressButton($this->article_page->get_create_button('SAVE_AND_PUBLISH'));
  }

  /**
   * @Given I press save and keep published
   */
  public function press_save_and_keep_published_button() {
    $this->HelperContext->getSession()
      ->getPage()
      ->pressButton($this->article_page->get_edit_button('SAVE_AND_KEEP_PUBLISHED'));
  }

  /**
   * @return string The /edit path for an Article.
   */
  public function get_edit_path() {
    return '/node/' . $this->article_node_id . '/edit/';
  }

  /**
   * @return string The /delete path for an Article.
   */
  public function get_delete_path() {
    return '/node/' . $this->article_node_id . '/delete/';
  }

  /**
   * @Given I visit the Create Article page
   */
  public function visit_create_article_page() {
    $this->HelperContext->visitPath($this->article_page->get_path());
  }

  /**
   * @Given I visit the Edit Article page
   */
  public function visit_edit_article_page() {
    $this->HelperContext->visitPath(self::get_edit_path());
  }

  /**
   * @Given I visit the Delete Article page
   */
  public function visit_delete_article_page() {
    $this->HelperContext->visitPath(self::get_delete_path());
  }

  /**
   * @Given I am still on the Create Article page
   */
  public function i_am_still_on_the_create_article_page() {
    $current_url = $this->HelperContext->getSession()->getCurrentUrl();
    if (strpos($current_url, $this->article_page->get_path()) === FALSE) {
      throw new CWContextException("No longer on the Create Article page, but on {$current_url}.");
    }
  }

  /**
   * @Given I am still on the Edit Article page
   */
  public function i_am_still_on_the_edit_article_page() {
    $current_url = $this->HelperContext->getSession()->getCurrentUrl();
    if (strpos($current_url, self::get_edit_path()) === FALSE) {
      throw new CWContextException("No longer on the Edit Article page, but on {$current_url}.");
    }
  }
  /**
   * @Given I enter the following values on the Create Article page
   * @Given I enter the following values on the Edit Article page
   */
  public function i_enter_the_following_values_on_the_create_edit_article_page(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      if ($field == 'TITLE') {
        self::fill_title_field($value);
      }
      if ($field == 'BODY') {
        self::fill_body_frame($value);
      }
      if ($field == 'IMAGE') {
        self::attach_image($value);
      }
      if ($field == 'ALT') {
        self::fill_alt_field($value);
      }
    }
  }

  /**
   * @Given I verify the structure of the Create Article page
   */
  public function i_verify_the_structure_of_the_create_article_page() {
    foreach ($this->article_page->get_all_fields() as $field) {
      Assertions::assertTrue($this->HelperContext->getSession()
        ->getPage()
        ->hasField($field), $field . ' field not found');
    }
    foreach ($this->article_page->get_all_frames() as $frame) {
      Assertions::assertTrue($this->HelperContext->hasFrame($frame), $frame . ' frame not found');
    }
    foreach ($this->article_page->get_all_create_buttons() as $button) {
      Assertions::assertTrue($this->HelperContext->getSession()
        ->getPage()
        ->hasButton($button), $button . ' button not found');
    }
  }

  /**
   * @Given I verify the structure of the Edit Article page
   */
  public function i_verify_the_structure_of_the_edit_article_page() {
    foreach ($this->article_page->get_all_fields() as $field) {
      Assertions::assertTrue($this->HelperContext->getSession()
        ->getPage()
        ->hasField($field), $field . ' field not found');
    }
    foreach ($this->article_page->get_all_frames() as $frame) {
      Assertions::assertTrue($this->HelperContext->hasFrame($frame), $frame . ' frame not found');
    }
    foreach ($this->article_page->get_all_edit_buttons() as $button) {
      Assertions::assertTrue($this->HelperContext->getSession()
        ->getPage()
        ->hasButton($button), $button . ' button not found');
    }
    foreach ($this->article_page->get_all_edit_links() as $link) {
      Assertions::assertTrue($this->HelperContext->getSession()
        ->getPage()
        ->hasLink($link), $link . ' link not found');
    }
  }

  /**
   * @Given I delete the article
   */
  public function i_delete_the_article() {
    $this->HelperContext->getSession()->getPage()->pressButton($this->article_page->get_edit_link('DELETE'));
  }

  /**
   * @Given I verify that the article was created successfully
   */
  public function i_verify_that_the_article_was_created_successfully() {
    $this->HelperContext->iCanSeeInTheRegion('Article ' . $this->article_page_title . ' has been created.', $this->article_page->get_message_region('SUCCESS_MESSAGE_REGION'));
    $this->article_node_id = $this->HelperContext->getNodeIDFromEDITLink();
  }

  /**
   * @Given I verify that the article was edited successfully
   */
  public function i_verify_that_the_article_was_edited_successfully() {
    $this->HelperContext->iCanSeeInTheRegion('Article ' . $this->article_page_title . ' has been updated.', $this->article_page->get_message_region('SUCCESS_MESSAGE_REGION'));
  }

  /**
   * @Given I verify that the article was deleted successfully
   */
  public function i_verify_that_the_article_was_deleted_successfully() {
    $this->HelperContext->iCanSeeInTheRegion('The Article ' . $this->article_page_title . ' has been deleted.', $this->article_page->get_message_region('SUCCESS_MESSAGE_REGION'));
  }

  /**
   * @Given I can see the following values on the View Article page
   */
  public function i_verify_the_following_values_on_the_view_article_page(TableNode $table) {
    foreach ($table->getHash() as $key => $value) {
      $field = trim($value['FIELD']);
      $value = trim($value['VALUE']);

      if ($field == 'TITLE') {
        $this->HelperContext->iCanSeeInTheRegion($value, $this->article_page->get_region('VIEW_TITLE'));
      }
      if ($field == 'BODY') {
        $this->HelperContext->iCanSeeInTheRegion($value, $this->article_page->get_region('VIEW_BODY'));
      }
    if ($field == 'IMAGE') {
        $this->HelperContext->minkContext->assertElementOnPage($this->article_page->get_region('VIEW_IMAGE'));
      }
      if ($field == 'ALT') {
        $this->HelperContext->iCanSeeTheValueInTheHTML($value);
      }
    }
  }
}

