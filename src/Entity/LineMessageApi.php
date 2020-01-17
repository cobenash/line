<?php

namespace Drupal\line\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Line Message API entity.
 *
 * @ConfigEntityType(
 *   id = "message_api",
 *   label = @Translation("Line Message API"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\line\LineMessageApiListBuilder",
 *     "form" = {
 *       "add" = "Drupal\line\Form\LineMessageApiForm",
 *       "edit" = "Drupal\line\Form\LineMessageApiForm",
 *       "delete" = "Drupal\line\Form\LineMessageApiDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\line\LineMessageApiHtmlRouteProvider",
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
 *     "canonical" = "/admin/config/system/line/message_api/{message_api}",
 *     "add-form" = "/admin/config/system/line/message_api/add",
 *     "edit-form" = "/admin/config/system/line/message_api/{message_api}/edit",
 *     "delete-form" = "/admin/config/system/line/message_api/{message_api}/delete",
 *     "collection" = "/admin/config/system/line/message_api"
 *   }
 * )
 */
class LineMessageApi extends ConfigEntityBase implements LineMessageApiInterface {

  /**
   * The Line Message API ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Line Message API label.
   *
   * @var string
   */
  protected $label;

}
