<?php

namespace FBMessengerBot;

use FBMessengerBot\Messages\Message;

class FbBotApp {
  /**
   * Request type GET
   */
  const TYPE_GET = "get";

  /**
   * Request type POST
   */
  const TYPE_POST = "post";

  /**
   * FB Messenger API Url
   *
   * @var string
   */
  protected $apiUrl = 'https://graph.facebook.com/v2.6/';

  /**
   * @var null|string
   */
  protected $token = NULL;

  /**
   * FbBotApp constructor.
   * @param string $token
   */
  public function __construct($token) {
    $this->token = $token;
  }

  /**
   * Send Message
   *
   * @param Message $message
   * @return array
   */
  public function send(Message $message) {
    return $this->call('me/messages', $message->getData());
  }

  /**
   * Get User Profile Info
   *
   * @param int $id
   * @param string $fields
   * @return UserProfile
   */
  public function userProfile($id, $fields = 'first_name,last_name,profile_pic,locale,timezone,gender') {
    return new UserProfile($this->call($id, [
      'fields' => $fields
    ], self::TYPE_GET));
  }

  /**
   * Request to API
   *
   * @param string $url
   * @param array $data
   * @param string $type Type of request (GET|POST)
   * @return array
   */
  protected function call($url, $data, $type = self::TYPE_POST) {
    $data['access_token'] = $this->token;

    $headers = [
      'Content-Type: application/json',
    ];

    if ($type == self::TYPE_GET) {
      $url .= '?' . http_build_query($data);
    }

    $process = curl_init($this->apiUrl . $url);
    curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($process, CURLOPT_HEADER, FALSE);
    curl_setopt($process, CURLOPT_TIMEOUT, 30);

    if ($type == self::TYPE_POST) {
      curl_setopt($process, CURLOPT_POST, 1);
      curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE);
    $return = curl_exec($process);
    curl_close($process);

    return json_decode($return, TRUE);
  }
}