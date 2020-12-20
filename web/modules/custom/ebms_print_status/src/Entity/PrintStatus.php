<?php

namespace Drupal\ebms_print_status\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the EBMS Print Status entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_print_status",
 *   label = @Translation("EBMS Print Status"),
 *   label_collection = @Translation("EBMS Print Status"),
 *   label_singular = @Translation("print status"),
 *   label_plural = @Translation("print statuses"),
 *   label_count = @PluralTranslation(
 *     singular = "@count print status",
 *     plural = "@count print statuses",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_print_status\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_print_status\Form\PrintStatusForm",
 *       "edit" = "Drupal\ebms_print_status\Form\PrintStatusForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "status",
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
 *     "add-form" = "/admin/content/ebms_print_status/add",
 *     "edit-form" = "/admin/content/ebms_print_status/{ebms_print_status}/edit",
 *     "delete-form" = "/admin/content/ebms_print_status/{ebms_print_status}/delete",
 *     "collection" = "/admin/content/ebms_print_status",
 *   },
 * )
 */
class PrintStatus extends ConfigEntityBase {

  /**
   * The machine name for the print status.
   *
   * @var string
   */
  public $id;

  /**
   * The print status name. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Longer descriptive help text explaining what the print status means.
   *
   * @var string
   */
  public $description;

}
