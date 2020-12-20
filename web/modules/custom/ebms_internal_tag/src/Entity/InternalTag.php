<?php

namespace Drupal\ebms_internal_tag\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Defines the EBMS internal tag value entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_internal_tag",
 *   label = @Translation("EBMS Internal Tag Value"),
 *   label_collection = @Translation("EBMS Internal Tag Values"),
 *   label_singular = @Translation("tag"),
 *   label_plural = @Translation("tags"),
 *   label_count = @PluralTranslation(
 *     singular = "@count tag",
 *     plural = "@count tags",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_internal_tag\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_internal_tag\Form\TagForm",
 *       "edit" = "Drupal\ebms_internal_tag\Form\TagForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "tag",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "active",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/ebms_internal_tag/add",
 *     "edit-form" = "/admin/content/ebms_internal_tag/{ebms_internal_tag}/edit",
 *     "delete-form" = "/admin/content/ebms_internal_tag/{ebms_internal_tag}/delete",
 *     "collection" = "/admin/content/ebms_internal_tag",
 *   },
 * )
 */
class InternalTag extends ConfigEntityBase {

  /**
   * The machine name for the tag value.
   *
   * @var string
   */
  public $id;

  /**
   * The tag name. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Whether the value can be used for future internal article tagging.
   *
   * @var bool
   */
  public $active;

  /**
   * {@inheritdoc}
   */
  public static function sort(ConfigEntityInterface $a, ConfigEntityInterface $b) {
    return strcmp($a->label, $b->label);
  }

}
