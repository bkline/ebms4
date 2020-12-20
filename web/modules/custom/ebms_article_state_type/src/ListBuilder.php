<?php

namespace Drupal\ebms_article_state_type;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a list controller for the EBMS article state types.
 *
 * Overriding the load() method doesn't work because Drupal
 * support for multiple-key sort for entity queries is broken.
 * Have to override the sort() method of the entity type class.
 */
class ListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['sequence'] = $this->t('Sequence');
    $header['id'] = $this->t('Machine ID');
    $header['label'] = $this->t('Label');
    $header['completed'] = $this->t('Terminal State');
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
    $row['completed'] = $entity->get('completed') ? 'Yes' : 'No';
    return $row + parent::buildRow($entity);
  }

}
