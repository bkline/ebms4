<?php

namespace Drupal\ebms_ad_hoc_group;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Ad-Hoc Group entities.
 *
 * @ingroup ebms
 */
class ListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Group ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    // Broken, I think. https://www.drupal.org/project/drupal/issues/2892334.
    return $this->t('Ad-Hoc Groups');
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\ebms_ad_hoc_group\Entity\AdHocGroup $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.ebms_ad_hoc_group.edit_form',
      ['ebms_ad_hoc_group' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
