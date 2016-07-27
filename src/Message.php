<?php

namespace PedroRochaNet\FBMessengerBot;

interface MessageInterface {

  /**
   * Get message data
   *
   * @return array
   */
  public function getData();
}