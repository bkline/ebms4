<?php

namespace Drupal\ebms_article;

use Drupal\Core\Cache\CacheableDependencyInterface;
use Drupal\Core\TypedData\TypedData;

/**
 * Single string to identify an article author.
 */
class AuthorName extends TypedData { //implements CacheableDependencyInterface {

  /**
   * Cached name.
   *
   * @var string|null
   */
  protected $authorName = NULL;

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    if (empty($this->authorName)) {
      $item = $this->getParent();
      $last_name = $item->last_name;
      if ($last_name) {
        $name = $last_name;
        $initials = $item->initials;
        if ($initials) {
          $name = "$name $initials";
        }
      }
      else {
        $name = $item->collective_name;
      }
      $this->authorName = empty($name) ? '' : $name;
    }
    return $this->authorName;
  }

}
