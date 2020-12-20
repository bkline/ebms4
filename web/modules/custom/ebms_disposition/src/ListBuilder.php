<?php

namespace Drupal\ebms_disposition;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a list controller for the EBMS review disposition values.
 */
class ListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Machine ID');
    $header['label'] = $this->t('Label');
    $header['sequence'] = $this->t('Sequence');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    // To debug, use dpm($entity).
    $row['id'] = $entity->get('id');
    $row['label'] = $entity->get('label');
    $row['sequence'] = $entity->get('sequence');
    return $row + parent::buildRow($entity);
  }

}
