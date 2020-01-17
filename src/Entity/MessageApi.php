<?php

namespace Drupal\line\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the LINE Message API entity.
 *
 * @ConfigEntityType(
 *   id = "message_api",
 *   label = @Translation("LINE Message API"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\line\MessageApiListBuilder",
 *     "form" = {
 *       "add" = "Drupal\line\Form\MessageApiForm",
 *       "edit" = "Drupal\line\Form\MessageApiForm",
 *       "delete" = "Drupal\line\Form\MessageApiDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\line\MessageApiHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "message_api",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/message_api/{message_api}",
 *     "add-form" = "/admin/structure/message_api/add",
 *     "edit-form" = "/admin/structure/message_api/{message_api}/edit",
 *     "delete-form" = "/admin/structure/message_api/{message_api}/delete",
 *     "collection" = "/admin/structure/message_api"
 *   }
 * )
 */
class MessageApi extends ConfigEntityBase implements MessageApiInterface {

  /**
   * The LINE Message API ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The LINE Message API label.
   *
   * @var string
   */
  protected $label;

  /**
   * The LINE Message API clientid.
   *
   * @var string
   */
  protected $clientid;

  /**
   * The LINE Message API secret.
   *
   * @var string
   */
  protected $secret;

  /**
   * Get Client ID.
   */
  public function getClientId() {
    return $this->clientid;
  }

  /**
   * {@inheritdoc}
   */
  public function setClientId(string $clientID) {
    $this->clientid = $clientID;
    return $this;
  }

  /**
   * Get Client secret.
   */
  public function getSecret() {
    return $this->secret;
  }

  /**
   * {@inheritdoc}
   */
  public function setSecret(string $secret) {
    $this->secret = $secret;
    return $this;
  }

}
