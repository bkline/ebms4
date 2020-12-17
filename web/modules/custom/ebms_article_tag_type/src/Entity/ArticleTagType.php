<?php

namespace Drupal\ebms_article_tag_type\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Valid values for article tags.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_article_tag_type",
 *   label_collection = @Translation("EBMS Article Tag Types"),
 *   label_singular = @Translation("tag"),
 *   label_plural = @Translation("tags"),
 *   label_count = @PluralTranslation(
 *     singular = "@count tag",
 *     plural = "@count tags",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_article_tag_type\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_article_tag_type\Form\ArticleTagTypeForm",
 *       "edit" = "Drupal\ebms_article_tag_type\Form\ArticleTagTypeForm",
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
 *     "topic_required",
 *     "active",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/ebms_article_tag_type/add",
 *     "edit-form" = "/admin/content/ebms_article_tag_type/{ebms_article_tag_type}/edit",
 *     "delete-form" = "/admin/content/ebms_article_tag_type/{ebms_article_tag_type}/delete",
 *     "collection" = "/admin/content/ebms_article_tag_type",
 *   },
 * )
 */
class ArticleTagType extends ConfigEntityBase {

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
   * Longer descriptive help text explaining what the tag is used for.
   *
   * @var string
   */
  public $description;

  /**
   * Position in the workflow sequence.
   *
   * Whether a topic must be specified for this tag.
   *
   * @var bool
   */
  public $topic_required;

  /**
   * Whether the value can be used for future tag assignments.
   *
   * @var bool
   */
  public $active;

}
