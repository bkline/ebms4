<?php

namespace Drupal\ebms_disposition\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Defines the EBMS disposition value entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_disposition",
 *   label = @Translation("EBMS Disposition Value"),
 *   label_collection = @Translation("EBMS Disposition Values"),
 *   label_singular = @Translation("disposition"),
 *   label_plural = @Translation("dispositions"),
 *   label_count = @PluralTranslation(
 *     singular = "@count disposition",
 *     plural = "@count dispositions",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_disposition\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_disposition\Form\DispositionForm",
 *       "edit" = "Drupal\ebms_disposition\Form\DispositionForm",
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
 *     "instructions",
 *     "sequence",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/ebms_disposition/add",
 *     "edit-form" = "/admin/content/ebms_disposition/{ebms_disposition}/edit",
 *     "delete-form" = "/admin/content/ebms_disposition/{ebms_disposition}/delete",
 *     "collection" = "/admin/content/ebms_disposition",
 *   },
 * )
 */
class Disposition extends ConfigEntityBase {

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
  public $instructions;

  /**
   * Position of the disposition value's checkbox in the user interface.
   *
   * @var int
   */
  public $sequence;

  /**
   * {@inheritdoc}
   */
  public static function sort(ConfigEntityInterface $a, ConfigEntityInterface $b) {
    return $a->sequence < $b->sequence ? -1 : 1;
  }

}
