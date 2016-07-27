<?php

namespace FBMessengerBot;

interface MessageInterface {

  /**
   * Get message data
   *
   * @return array
   */
  public function getData();
}