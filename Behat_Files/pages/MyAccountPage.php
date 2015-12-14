<?php

class MyAccountPage
{
  /**
   * @var string $path
   */
  public $path = '/user';

  /**
   * @var array $fields
   */
  private $fields = array();

  /**
   * @var array $regions
   */
  private $regions = array(
    'TOOLBAR' => '#toolbar-bar',
    'CONTENT' => '.layout-content'
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
}