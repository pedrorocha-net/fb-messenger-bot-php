<?php

namespace pedrorochanet\Messages;

/**
 * Class Message
 *
 * @package pedrorochanet\Messages
 */
class Message {
  /**
   * @var null|string
   */
  protected $recipient = NULL;

  /**
   * @var null|string
   */
  protected $text = NULL;

  /**
   * Message constructor.
   *
   * @param string $recipient
   * @param string $text
   */
  public function __construct($recipient, $text) {
    $this->recipient = $recipient;
    $this->text = $text;
  }

  /**
   * Get message data
   *
   * @return array
   */
  public function getData() {
    return [
      'recipient' => [
        'id' => $this->recipient
      ],
      'message' => [
        'text' => $this->text
      ]
    ];
  }
}