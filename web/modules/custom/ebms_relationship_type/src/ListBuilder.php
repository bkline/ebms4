<?php

namespace Drupal\ebms_relationship_type;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a list controller for the EBMS article relationship types.
 */
class ListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Machine ID');
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    // To debug, use dpm($entity).
    $row['id'] = $entity->get('id');
    $row['label'] = $entity->get('label');
    return $row + parent::buildRow($entity);
  }

}
