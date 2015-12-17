<?php

class Page {

  /**
   * Buttons visible in Create mode.
   * @var array $create_buttons
   */
  private $create_buttons = array(
    'SAVE_AND_PUBLISH' => 'Save and publish',
    'SAVE_AS_UNPUBLISHED' => 'Save as unpublished',
    'PREVIEW' => 'Preview'
  );

  /**
   * Buttons visible in Edit mode.
   * @var array $edit_buttons
   */
  private $edit_buttons = array(
    'REMOVE' => 'Remove',
    'SAVE_AND_KEEP_PUBLISHED' => 'Save and keep published',
    'SAVE_AND_UNPUBLISH' => 'Save and unpublish',
    'PREVIEW' => 'Preview'
  );

  /**
   * A specific create button.
   * @return string
   */
  function get_create_button($button) {
    return $this->create_buttons[$button];
  }

  /**
   * A specific create button.
   * @return string
   */
  function get_edit_button($button) {
    return $this->edit_buttons[$button];
  }
}