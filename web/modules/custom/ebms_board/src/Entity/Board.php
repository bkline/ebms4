<?php

namespace Drupal\ebms_board\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the PDQ Board entity.
 *
 * @ingroup ebms
 *
 * @ContentEntityType(
 *   id = "ebms_board",
 *   label = @Translation("PDQ Board"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ebms_board\BoardListBuilder",
 *
 *     "form" = {
 *       "default" = "Drupal\ebms_board\Form\BoardForm",
 *       "add" = "Drupal\ebms_board\Form\BoardForm",
 *       "edit" = "Drupal\ebms_board\Form\BoardForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "ebms_board",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "published" = "active",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/board/{ebms_board}",
 *     "add-form" = "/admin/structure/board/add",
 *     "edit-form" = "/admin/structure/board/{ebms_board}/edit",
 *     "delete-form" = "/admin/structure/board/{ebms_board}/delete",
 *     "collection" = "/admin/structure/board",
 *   }
 * )
 */
class Board extends ContentEntityBase implements ContentEntityInterface {

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
      ->setDescription(t('The name of the PDQ Board.'))
      ->setRevisionable(FALSE)
      ->setTranslatable(FALSE)
      ->setSettings([
        'max_length' => 128,
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

    $fields['manager'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Board manager'))
      ->setSetting('target_type', 'user')
      ->setDisplayOptions('view', [
        'weight' => -3,
        'label' => 'above',
      ])
      ->setDisplayOptions('form', [
        'weight' => -3,
        'type' => 'entity_reference_autocomplete',
      ])
      ->setDescription(t('User responsible for coordinating the literature review.'))
      ->setRevisionable(FALSE)
      ->setTranslatable(FALSE);

    $fields['loe_guidelines'] = BaseFieldDefinition::create('file')
      ->setLabel(t('LOE guidelines'))
      ->setSetting('file_extensions', 'doc docx pdf')
      ->setDisplayOptions('view', [
        'weight' => -2,
        'label' => 'above',
      ])
      ->setDisplayOptions('form', [
        'weight' => -2,
        'type' => 'file_generic'
      ])
      ->setDescription(t('Level-of-evidence guidelines file.'))
      ->setRevisionable(FALSE)
      ->setTranslatable(FALSE);

    $fields['auto_imports'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Automatic imports'))
      ->setDescription(t('Should the import software look for related articles?'))
      ->setDefaultValue(FALSE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -1,
      ]);

    $fields['active'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Active'))
      ->setDescription(t('A flag indicating whether the PDQ Board is active.'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 0,
      ]);

    return $fields;
  }

}
