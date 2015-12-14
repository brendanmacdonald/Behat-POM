<?php

class ArticlePage {

  /**
   * @var string $path
   */
  private $path = '/node/add/article';

  /**
   * @var array $fields
   */
  private $fields = array(
    'TITLE' => 'edit-title-0-value',
    'IMAGE' => 'edit-field-image-0-upload'
  );

  /**
   * @var array $hidden_fields
   */
  private $hidden_fields = array(
    'ALT' => 'edit-field-image-0-alt'
  );

  /**
   * @var array $frames
   */
  private $frames = array(
    'BODY' => 'cke_edit-body-0-value'
  );

  /**
   * @var array $create_buttons
   */
  private $create_buttons = array(
    'SAVE_AND_PUBLISH' => 'Save and publish',
    'SAVE_AS_UNPUBLISHED' => 'Save as unpublished',
    'PREVIEW' => 'Preview'
  );

  /**
   * @var array $edit_buttons
   */
  private $edit_buttons = array(
    'REMOVE' => 'Remove',
    'SAVE_AND_KEEP_PUBLISHED' => 'Save and keep published',
    'SAVE_AND_UNPUBLISH' => 'Save and unpublish',
    'PREVIEW' => 'Preview',
    'DELETE' => 'Delete'
  );

  /**
   * @var array $regions
   */
  private $regions = array();

  /**
   * @var array $message_regions
   */
  private $message_regions = array(
    'SUCCESS_MESSAGE_REGION' => '.messages.messages--status'
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
   * @return string A specific hidden field.
   */
  function get_hidden_field($hidden_field) {
    return $this->hidden_fields[$hidden_field];
  }

  /**
   * @return array All create buttons.
   */
  function get_all_create_buttons() {
    return $this->create_buttons;
  }

  /**
   * @return string A specific create button.
   */
  function get_create_button($button) {
    return $this->create_buttons[$button];
  }

  /**
   * @return array All edit buttons.
   */
  function get_all_edit_buttons() {
    return $this->edit_buttons;
  }

  /**
   * @return string A specific create button.
   */
  function get_edit_button($button) {
    return $this->edit_buttons[$button];
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
   * @return array All frames.
   */
  function get_all_frames() {
    return $this->frames;
  }

  /**
   * @return string A specific frame.
   */
  function get_frame($frame) {
    return $this->frames[$frame];
  }

  /**
   * @return string A specific message region.
   */
  function get_message_region($region) {
    return $this->message_regions[$region];
  }
}