<?php

namespace Drupal\ebms_ad_hoc_group\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Defines the ad-hoc group entity.
 *
 * @ingroup ebms
 *
 * @ContentEntityType(
 *   id = "ebms_ad_hoc_group",
 *   label = @Translation("Ad-Hoc Group"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ebms_ad_hoc_group\ListBuilder",
 *
 *     "form" = {
 *       "default" = "Drupal\ebms_ad_hoc_group\Form\AdHocGroupForm",
 *       "add" = "Drupal\ebms_ad_hoc_group\Form\AdHocGroupForm",
 *       "edit" = "Drupal\ebms_ad_hoc_group\Form\AdHocGroupForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "ebms_ad_hoc_group",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/ebms/ad_hoc_group/{ebms_ad_hoc_group}",
 *     "add-form" = "/admin/config/ebms/add_hoc_group/add",
 *     "edit-form" = "/admin/config/ebms/add_hoc_group/{ebms_ad_hoc_group}/edit",
 *     "delete-form" = "/admin/config/ebms/add_hoc_group/{ebms_ad_hoc_group}/delete",
 *     "collection" = "/admin/config/ebms/add_hoc_group",
 *   }
 * )
 */
class AdHocGroup extends ContentEntityBase implements ContentEntityInterface {

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
      ->setDescription(t('The name of the ad-hoc group.'))
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

    $fields['created_by'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Created By'))
      ->setSetting('target_type', 'user')
      ->setDisplayOptions('view', [
        'weight' => -3,
        'label' => 'above',
      ])
      ->setDisplayOptions('form', [
        'weight' => -3,
        'type' => 'entity_reference_autocomplete',
      ])
      ->setDescription(t('User who created this group.'))
      ->setRevisionable(FALSE)
      ->setTranslatable(FALSE);

    $fields['boards'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('PDQ® Editorial Boards'))
      ->setSetting('target_type', 'ebms_board')
      ->setCardinality(FieldStorageDefinitionInterface::CARDINALITY_UNLIMITED)
      ->setDisplayOptions('view', [
        'weight' => -2,
        'label' => 'above',
      ])
      ->setDisplayOptions('form', [
        'weight' => -2,
        'type' => 'entity_reference_autocomplete',
      ])
      ->setDescription(t('Board(s) associated with this group.'))
      ->setRevisionable(FALSE)
      ->setTranslatable(FALSE);

    return $fields;
  }

}
