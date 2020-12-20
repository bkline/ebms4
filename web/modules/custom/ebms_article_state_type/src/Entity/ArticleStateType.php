<?php

namespace Drupal\ebms_article_state_type\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Defines the EBMS article state type entity.
 *
 * @ingroup ebms
 *
 * @ConfigEntityType(
 *   id = "ebms_article_state_type",
 *   label = @Translation("EBMS Article State Type"),
 *   label_collection = @Translation("EBMS Article State Types"),
 *   label_singular = @Translation("state"),
 *   label_plural = @Translation("states"),
 *   label_count = @PluralTranslation(
 *     singular = "@count state",
 *     plural = "@count states",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\ebms_article_state_type\ListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ebms_article_state_type\Form\ArticleStateTypeForm",
 *       "edit" = "Drupal\ebms_article_state_type\Form\ArticleStateTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "state",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *     "sequence",
 *     "completed",
 *     "active",
 *   },
 *   links = {
 *     "add-form" = "/admin/content/ebms_article_state_type/add",
 *     "edit-form" = "/admin/content/ebms_article_state_type/{ebms_article_state_type}/edit",
 *     "delete-form" = "/admin/content/ebms_article_state_type/{ebms_article_state_type}/delete",
 *     "collection" = "/admin/content/ebms_article_state_type",
 *   },
 * )
 */
class ArticleStateType extends ConfigEntityBase {

  /**
   * The machine name for the state value.
   *
   * @var string
   */
  public $id;

  /**
   * The state type label. This is what is displayed for the user.
   *
   * @var string
   */
  public $label;

  /**
   * Longer descriptive help text explaining what the state value means.
   *
   * @var string
   */
  public $description;

  /**
   * Position in the workflow sequence.
   *
   * States with lower sequence numbers are entered before states with higher
   * sequence numbers. There can be multiple valid state values with the same
   * sequence number, indicating alternate branches for decision-making about
   * an article's disposition for a given topic at one point in the processing.
   * In several places, the software fetches the sequence number for a known
   * state so that it can then look for article/topic combinations whose current
   * state has that same sequence number (or has an earlier, or a later number).
   *
   * @var int
   */
  public $sequence;

  /**
   * Whether this state indicates a final state for the article.
   *
   * @var bool
   */
  public $completed;

  /**
   * Whether the value can be used for future state assignments.
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
