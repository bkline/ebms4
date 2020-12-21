<?php

namespace Drupal\ebms_rejection_reason\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Valid values for reasons explaining why an article was rejected.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_rejection_reason",
 *   label_collection = @Translation("EBMS Article Rejection Reason"),
 *   label_singular = @Translation("reason"),
 *   label_plural = @Translation("reasons"),
 *   label_count = @PluralTranslation(
 *     singular = "@count reason",
 *     plural = "@count reasons",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_rejection_reason\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_rejection_reason\Form\RejectionReasonForm",
 *       "edit" = "Drupal\ebms_rejection_reason\Form\RejectionReasonForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "reason",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "sequence",
 *     "extra_info",
 *     "active",
 *   },
 *   links = {
 *     "add-form" = "/admin/config/ebms/rejection_reason/add",
 *     "edit-form" = "/admin/config/ebms/rejection_reason/{ebms_rejection_reason}/edit",
 *     "delete-form" = "/admin/config/ebms/rejection_reason/{ebms_rejection_reason}/delete",
 *     "collection" = "/admin/config/ebms/rejection_reason",
 *   },
 * )
 */
class RejectionReason extends ConfigEntityBase {

  /**
   * The machine name for the reason value.
   *
   * @var string
   */
  public $id;

  /**
   * The reason name. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Position of the value on the review form.
   *
   * @var int
   */
  public $sequence;

  /**
   * Optional additional explanation for the user interface.
   *
   * @var string
   */
  public $extra_info;

  /**
   * Whether the value can be used for future article reviews.
   *
   * @var bool
   */
  public $active;

  /**
   * {@inheritdoc}
   */
  public static function sort(ConfigEntityInterface $a, ConfigEntityInterface $b) {
    if ($a->sequence === $b->sequence) {
      return strcmp($a->label, $b->label);
    }
    return $a->sequence < $b->sequence ? -1 : 1;
  }

}
