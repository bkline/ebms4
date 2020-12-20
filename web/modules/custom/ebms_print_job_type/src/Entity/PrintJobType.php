<?php

namespace Drupal\ebms_print_job_type\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the EBMS print job type entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_print_job_type",
 *   label = @Translation("EBMS Print Job Type"),
 *   label_collection = @Translation("EBMS Print Job Type"),
 *   label_singular = @Translation("print job type"),
 *   label_plural = @Translation("print job types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count print job type",
 *     plural = "@count print job types",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_print_job_type\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_print_job_type\Form\PrintJobTypeForm",
 *       "edit" = "Drupal\ebms_print_job_type\Form\PrintJobTypeForm",
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
 *   },
 *   links = {
 *     "add-form" = "/admin/content/ebms_print_job_type/add",
 *     "edit-form" = "/admin/content/ebms_print_job_type/{ebms_print_job_type}/edit",
 *     "delete-form" = "/admin/content/ebms_print_job_type/{ebms_print_job_type}/delete",
 *     "collection" = "/admin/content/ebms_print_job_type",
 *   },
 * )
 */
class PrintJobType extends ConfigEntityBase {

  /**
   * The machine name for the print job type.
   *
   * @var string
   */
  public $id;

  /**
   * The job type name. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Longer descriptive help text explaining what the job type means.
   *
   * @var string
   */
  public $description;

}
