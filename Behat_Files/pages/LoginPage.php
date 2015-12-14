<?php

class LoginPage {

  /**
   * @var string $path
   */
  public $path = '/user/login';

  /**
   * @var array $fields
   */
  private $fields = array(
    'USERNAME' => 'edit-name',
    'PASSWORD' => 'edit-pass'
  );

  /**
   * @var array $buttons
   */
  private $buttons = array(
    'LOG_IN' => 'edit-submit'
  );

  /**
   * @var array $regions
   */
  private $regions = array(
    'USER_LOGIN_FORM' => '#user-login-form'
  );

  /**
   * @var array $message_regions
   */
  private $message_regions = array(
    'LOGIN_FAILURE' => '.messages.messages--error'
  );

  /**
   * @return string The path.
   */
  function get_path() {
    return $this->path;
  }

  /**
   * @return array All fields.
   */
  function get_all_fields() {
    return $this->fields;
  }

  /**
   * @return string A specific field.
   */
  function get_field($field) {
    return $this->fields[$field];
  }

  /**
   * @return array All buttons.
   */
  function get_all_buttons() {
    return $this->buttons;
  }

  /**
   * @return string A specific button.
   */
  function get_button($button) {
    return $this->buttons[$button];
  }

  /**
   * @return array All regions.
   */
  function get_all_regions() {
    return $this->regions;
  }

  /**
   * @return string A specific region.
   */
  function get_region($region) {
    return $this->regions[$region];
  }

  /**
   * @return string A specific message region.
   */
  function get_message_region($region) {
    return $this->message_regions[$region];
  }
}