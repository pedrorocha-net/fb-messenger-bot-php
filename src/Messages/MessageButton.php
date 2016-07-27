<?php

namespace PedroRochaNet\FBMessengerBot\Messages;

/**
 * Class MessageButton
 * @package PedroRochaNet\FBMessengerBot\Messages
 */
class MessageButton {
  /**
   * Web url button type
   */
  const TYPE_WEB = "web_url";

  /**
   * Postback button type
   */
  const TYPE_POSTBACK = "postback";

  /**
   * Button type
   *
   * @var null|string
   */
  protected $type = NULL;

  /**
   * Button title
   *
   * @var null|string
   */
  protected $title = NULL;

  /**
   * Button url
   *
   * @var null|string
   */
  protected $url = NULL;

  /**
   * MessageButton constructor.
   *
   * @param string $type
   * @param string $title
   * @param string $url url or postback
   */
  public function __construct($type, $title, $url = '') {
    $this->type = $type;
    $this->title = $title;

    if (!$url) {
      $url = $title;
    }

    $this->url = $url;
  }

  /**
   * Get Button data
   *
   * @return array
   */
  public function getData() {
    $result = [
      'type' => $this->type,
      'title' => $this->title,
    ];

    switch ($this->type) {
      case self::TYPE_POSTBACK:
        $result['payload'] = $this->url;
        break;

      case self::TYPE_WEB:
        $result['url'] = $this->url;
        break;
    }

    return $result;
  }
}