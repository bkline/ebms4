<?php

namespace Drupal\ebms_relationship_type\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the EBMS relationship type.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_relationship_type",
 *   label = @Translation("EBMS Relationship Type"),
 *   label_collection = @Translation("EBMS Relationship Types"),
 *   label_singular = @Translation("type"),
 *   label_plural = @Translation("types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count type",
 *     plural = "@count types",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_relationship_type\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_relationship_type\Form\RelationshipTypeForm",
 *       "edit" = "Drupal\ebms_relationship_type\Form\RelationshipTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "type",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "active",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/ebms_relationship_type/add",
 *     "edit-form" = "/admin/content/ebms_relationship_type/{ebms_relationship_type}/edit",
 *     "delete-form" = "/admin/content/ebms_relationship_type/{ebms_relationship_type}/delete",
 *     "collection" = "/admin/content/ebms_relationship_type",
 *   },
 * )
 */
class RelationshipType extends ConfigEntityBase {

  /**
   * The machine name for the relationship type.
   *
   * @var string
   */
  public $id;

  /**
   * The relationship name. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Longer descriptive help text explaining what the relationship type means.
   *
   * @var string
   */
  public $description;

  /**
   * Whether the value can be used for future article relationships.
   *
   * @var bool
   */
  public $active;

}
