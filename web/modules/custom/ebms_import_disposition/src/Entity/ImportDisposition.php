<?php

namespace Drupal\ebms_import_disposition\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the EBMS import disposition value entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_import_disposition",
 *   label = @Translation("EBMS Import Disposition Value"),
 *   label_collection = @Translation("EBMS Import Disposition Values"),
 *   label_singular = @Translation("disposition"),
 *   label_plural = @Translation("dispositions"),
 *   label_count = @PluralTranslation(
 *     singular = "@count disposition",
 *     plural = "@count dispositions",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_import_disposition\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_import_disposition\Form\DispositionForm",
 *       "edit" = "Drupal\ebms_import_disposition\Form\DispositionForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "disposition",
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
 *     "add-form" = "/admin/content/ebms_import_disposition/add",
 *     "edit-form" = "/admin/content/ebms_import_disposition/{ebms_import_disposition}/edit",
 *     "delete-form" = "/admin/content/ebms_import_disposition/{ebms_import_disposition}/delete",
 *     "collection" = "/admin/content/ebms_import_disposition",
 *   },
 * )
 */
class ImportDisposition extends ConfigEntityBase {

  /**
   * The machine name for the disposition value.
   *
   * @var string
   */
  public $id;

  /**
   * The disposition name. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Longer descriptive help text explaining what the disposition value means.
   *
   * @var string
   */
  public $description;

  /**
   * Whether the value can be used for future import dispositions.
   *
   * @var bool
   */
  public $active;

}
