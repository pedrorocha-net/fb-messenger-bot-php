<?php

namespace PedroRochaNet\FBMessengerBot\Messages;

/**
 * Class MessageElement
 *
 * @package PedroRochaNet\FBMessengerBot\Messages
 */
class MessageElement {
  /**
   * Title
   *
   * @var null|string
   */
  protected $title = NULL;

  /**
   * Image url
   *
   * @var null|string
   */
  protected $image_url = NULL;

  /**
   * Subtitle
   *
   * @var null|string
   */
  protected $subtitle = NULL;

  /**
   * Buttons
   *
   * @var array
   */
  protected $buttons = [];

  /**
   * MessageElement constructor.
   *
   * @param string $title
   * @param string $subtitle
   * @param string $image_url
   * @param array $buttons
   */
  public function __construct($title, $subtitle, $image_url = '', $buttons = []) {
    $this->title = $title;
    $this->subtitle = $subtitle;
    $this->image_url = $image_url;
    $this->buttons = $buttons;
  }

  /**
   * Get Element data
   *
   * @return array
   */
  public function getData() {
    $result = [
      'title' => $this->title,
      'subtitle' => $this->subtitle,
      'image_url' => $this->image_url,
    ];

    if (!empty($this->buttons)) {
      $result['buttons'] = [];

      foreach ($this->buttons as $btn) {
        $result['buttons'][] = $btn->getData();
      }
    }

    return $result;
  }
}