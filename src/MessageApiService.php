<?php

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use Drupal\Core\Entity\EntityTypeManagerInterface;

namespace Drupal\line;

/**
 * Class MessageApiService.
 */
class MessageApiService implements MessageApiServiceInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a new MessageApiService object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager service.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * This is the function provides connecting with line api.
   */
  public function getLineConnect($machineId) {
    $configEntity = $this->entityTypeManager->getStorage('message_api')->load($machineId);
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
