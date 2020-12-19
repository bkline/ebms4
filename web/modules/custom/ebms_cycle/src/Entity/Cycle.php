<?php

namespace Drupal\ebms_cycle\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Defines the EBMS Cycle entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_cycle",
 *   label = @Translation("EBMS Cycle"),
 *   label_collection = @Translation("EBMS Cycles"),
 *   label_singular = @Translation("cycle"),
 *   label_plural = @Translation("cycles"),
 *   label_count = @PluralTranslation(
 *     singular = "@count cycle",
 *     plural = "@count cycles",
 *   ),
 *   config_prefix = "cycle",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "start",
 *   }
 * )
 */
class Cycle extends ConfigEntityBase {

  /**
   * The machine name for the cycle.
   *
   * @var string
   */
  public $id;

  /**
   * The display name for the cycle.
   *
   * @var string
   */
  public $label;

  /**
   * Date for the beginning of the cycle.
   *
   * @var timestamp
   */
  public $date;

  /**
   * {@inheritdoc}
   */
  public static function sort(ConfigEntityInterface $a, ConfigEntityInterface $b) {
    return $a->get('start') < $b->get('start') ? -1 : 1;
  }

}
