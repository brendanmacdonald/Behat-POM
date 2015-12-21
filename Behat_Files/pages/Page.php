<?php

class Page {

  /**
   * Buttons.
   * @var array $create_buttons
   */
  private $buttons = array(
    'SAVE_AND_PUBLISH' => 'Save and publish',
    'SAVE_AND_KEEP_PUBLISHED' => 'Save and keep published',
  );

  /**
   * A specific button.
   * @return string
   */
  public function get_button($button) {
    return $this->buttons[$button];
  }
}