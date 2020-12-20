<?php

namespace Drupal\ebms_document_tag\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the EBMS document tag configuration entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_document_tag",
 *   label = @Translation("EBMS Document Tag"),
 *   label_collection = @Translation("EBMS Document Tag Values"),
 *   label_singular = @Translation("tag"),
 *   label_plural = @Translation("tags"),
 *   label_count = @PluralTranslation(
 *     singular = "@count tag",
 *     plural = "@count tags",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_document_tag\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_document_tag\Form\DocumentTagForm",
 *       "edit" = "Drupal\ebms_document_tag\Form\DocumentTagForm",
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
 *     "description",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/ebms_document_tag/add",
 *     "edit-form" = "/admin/content/ebms_document_tag/{ebms_document_tag}/edit",
 *     "delete-form" = "/admin/content/ebms_document_tag/{ebms_document_tag}/delete",
 *     "collection" = "/admin/content/ebms_document_tag",
 *   },
 * )
 */
class DocumentTag extends ConfigEntityBase {

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
   * Longer descriptive help text explaining what the tag means.
   *
   * @var string
   */
  public $description;

}
