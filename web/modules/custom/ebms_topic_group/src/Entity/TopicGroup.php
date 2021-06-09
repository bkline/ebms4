<?php

namespace Drupal\ebms_topic_group\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Values for grouping EBMS topics.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_topic_group",
 *   label = @Translation("EBMS Topic Group"),
 *   label_collection = @Translation("EBMS Topic Group"),
 *   label_singular = @Translation("group"),
 *   label_plural = @Translation("groups"),
 *   label_count = @PluralTranslation(
 *     singular = "@count group",
 *     plural = "@count groups",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_topic_group\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_topic_group\Form\TopicGroupForm",
 *       "edit" = "Drupal\ebms_topic_group\Form\TopicGroupForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "topic_group",
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
 *     "add-form" = "/admin/config/ebms/topic_group/add",
 *     "edit-form" = "/admin/config/ebms/topic_group/{ebms_topic_group}/edit",
 *     "delete-form" = "/admin/config/ebms/topic_group/{ebms_topic_group}/delete",
 *     "collection" = "/admin/config/ebms/topic_group",
 *   },
 * )
 */
class TopicGroup extends ConfigEntityBase {

  /**
   * The machine name for the topic group value.
   *
   * @var string
   */
  public $id;

  /**
   * The topic group name. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Whether the value can be used for future import topic groups.
   *
   * @var bool
   */
  public $active;

}
