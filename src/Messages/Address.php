<?php

namespace FBMessengerBot\Messages;

/**
 * Class Address
 *
 * @package FBMessengerBot\Messages
 */
class Address {
  /**
   * @var array
   */
  protected $data = [];

  /**
   * Address constructor.
   *
   * @param array $data
   */
  public function __construct($data) {
    $this->data = $data;
  }

  /**
   * Get Data
   *
   * @return array
   */
  public function getData() {
    return $this->data;
  }
}