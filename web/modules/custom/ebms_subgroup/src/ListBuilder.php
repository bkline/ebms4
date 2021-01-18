<?php

namespace Drupal\ebms_subgroup;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Subgroup entities.
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
    return $this->t('Subgroups');
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\ebms_subgroup\Entity\Subgroup $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.ebms_subgroup.edit_form',
      ['ebms_subgroup' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
