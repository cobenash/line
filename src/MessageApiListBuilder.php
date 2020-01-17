<?php

namespace Drupal\line;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of LINE Message API entities.
 */
class MessageApiListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('LINE Message API');
    $header['id'] = $this->t('Machine name');
    $header['webhook_url'] = $this->t('Webhook URL');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['id'] = $entity->id();
    $row['webhook_url'] = \Drupal::request()->getSchemeAndHttpHost() . '/line_msg_api/' . $entity->id() . '/callback';
    return $row + parent::buildRow($entity);
  }

}
