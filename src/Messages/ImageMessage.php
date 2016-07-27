<?php

namespace pedrorochanet\Messages;

/**
 * Class ImageMessage
 *
 * @package pedrorochanet\Messages
 */
class ImageMessage {
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
   * @param string $file Web Url or local file with @ prefix
   */
  public function __construct($recipient, $file) {
    $this->recipient = $recipient;
    $this->text = $file;
  }

  /**
   * Get message data
   *
   * @return array
   */
  public function getData() {
    $res = [
      'recipient' => [
        'id' => $this->recipient
      ]
    ];

    if (strpos($this->text, 'http://') === 0 || strpos($this->text, 'https://') === 0) {

      // Url

      $res['message'] = [
        'attachment' => [
          'type' => 'image',
          'payload' => [
            'url' => $this->text
          ]
        ]
      ];
    }
    else {

      // Local file

      $res['message'] = [
        'attachment' => [
          'type' => 'image',
          'payload' => []
        ]

      ];

      $res['filedata'] = $this->getCurlValue($this->text, mime_content_type($this->text), basename($this->text));
    }

    return $res;
  }

  /**
   * @param string $filename
   * @param string $contentType
   * @param string $postname
   * @return \CURLFile|string
   */
  protected function getCurlValue($filename, $contentType, $postname) {
    // PHP 5.5 introduced a CurlFile object that deprecates the old @filename syntax
    // See: https://wiki.php.net/rfc/curl-file-upload
    if (function_exists('curl_file_create')) {
      return curl_file_create($filename, $contentType, $postname);
    }

    // Use the old style if using an older version of PHP
    $value = "@{$this->filename};filename=" . $postname;
    if ($contentType) {
      $value .= ';type=' . $contentType;
    }

    return $value;
  }
}