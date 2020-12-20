<?php

namespace Drupal\ebms_rejection_reason;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a list controller for the EBMS article rejection reasons.
 */
class ListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['sequence'] = $this->t('Sequence');
    $header['id'] = $this->t('Machine ID');
    $header['label'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    // To debug, use dpm($entity).
    $row['sequence'] = $entity->get('sequence');
    $row['id'] = $entity->get('id');
    $row['label'] = $entity->get('label');
    return $row + parent::buildRow($entity);
  }

}
