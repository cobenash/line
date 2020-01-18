<?php

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

namespace Drupal\line;

/**
 * Class MessageApiService.
 */
class MessageApiService implements MessageApiServiceInterface {

  /**
   * Constructs a new MessageApiService object.
   */
  public function __construct() {

  }

  /**
   * This is the function provides connecting with line api.
   *
   * @param [type] $machineId
   *
   * @return void
   */
  public function LineConnect($machineId) {
    $configEntity = \Drupal::entityTypeManager()->getStorage('message_api')->load($machineId);
    $clientId = $configEntity->getClientId();
    $clientSecret = $configEntity->getSecret();
    $httpClient = new CurlHTTPClient($clientSecret);
    $bot = new LINEBot($httpClient, ['channelSecret' => $$clientId]);
    return $bot;
  }

  /**
   * Test public function.
   */
  public function api() {

    return 'HelloSanta';
  }

}
