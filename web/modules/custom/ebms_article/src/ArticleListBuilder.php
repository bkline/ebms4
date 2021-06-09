<?php

namespace Drupal\ebms_article;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of PDQ Board entities.
 *
 * @ingroup ebms
 */
class ArticleListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('EBMS Article ID');
    $header['source-id'] = $this->t('Source ID');
    $header['citation'] = $this->t('Citation');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function getTitle() {
    // Broken, I think. https://www.drupal.org/project/drupal/issues/2892334.
    return $this->t('Articles');
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\ebms_article\Entity\Article $entity */
    $row['id'] = $entity->id();
    $row['source-id'] = $entity->source_id->value;
    $row['citation'] = $entity->getLabel();
    return $row + parent::buildRow($entity);
  }

}
