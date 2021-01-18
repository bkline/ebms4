<?php

namespace Drupal\ebms_subgroup\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the subgroup entity.
 *
 * @ingroup ebms
 *
 * @ContentEntityType(
 *   id = "ebms_subgroup",
 *   label = @Translation("Subgroup"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ebms_subgroup\ListBuilder",
 *
 *     "form" = {
 *       "default" = "Drupal\ebms_subgroup\Form\SubgroupForm",
 *       "add" = "Drupal\ebms_subgroup\Form\SubgroupForm",
 *       "edit" = "Drupal\ebms_subgroup\Form\SubgroupForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "ebms_subgroup",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/ebms/subgroup/{ebms_subgroup}",
 *     "add-form" = "/admin/config/ebms/subgroup/add",
 *     "edit-form" = "/admin/config/ebms/subgroup/{ebms_subgroup}/edit",
 *     "delete-form" = "/admin/config/ebms/subgroup/{ebms_subgroup}/delete",
 *     "collection" = "/admin/config/ebms/subgroup",
 *   }
 * )
 */
class Subgroup extends ContentEntityBase implements ContentEntityInterface {

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(
    EntityTypeInterface $entity_type
  ) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the subgroup.'))
      ->setRevisionable(FALSE)
      ->setTranslatable(FALSE)
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setRequired(TRUE);

    $fields['board'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('PDQ® Editorial Board'))
      ->setSetting('target_type', 'ebms_board')
      ->setDisplayOptions('view', [
        'weight' => -2,
        'label' => 'above',
      ])
      ->setDisplayOptions('form', [
        'weight' => -2,
        'type' => 'entity_reference_autocomplete',
      ])
      ->setDescription(t('Board associated with this group.'))
      ->setRevisionable(FALSE)
      ->setTranslatable(FALSE)
      ->setRequired(TRUE);

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public static function sort(ContentEntityInterface $a, ContentEntityInterface $b) {
    return strcmp($a->getName(), $b->getName());
  }

}
