<?php

namespace Drupal\ebms_article\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Implements an articulated author name(s) field.
 *
 * @FieldType(
 *   id = "ebms_author",
 *   label = @Translation("Author"),
 *   description = @Translation("Contributer to an article"),
 *   translatable = FALSE
 * )
 */
class Author extends FieldItemBase {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(
    FieldStorageDefinitionInterface $field_definition
  ) {
    return [
      'last_name' => DataDefinition::create('string')
        ->setLabel('Last Name'),
      'first_name' => DataDefinition::create('string')
        ->setLabel('First Name'),
      'initials' => DataDefinition::create('string')
        ->setLabel('Forename Initials'),
      'collective_name' => DataDefinition::create('string')
        ->setLabel('Collective Name'),
      'name' => DataDefinition::create('string')
        ->setLabel('Name')
        ->setComputed(TRUE)
        ->setClass('\Drupal\ebms_article\AuthorName')
        ->setInternal(FALSE),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(
    FieldStorageDefinitionInterface $field_definition
  ) {
    return [
      'columns' => [
        'last_name' => [
          'description' => 'Surname for personal author',
          'type' => 'varchar',
          'length' => 255,
        ],
        'first_name' => [
          'description' => 'Given name(s) for personal author',
          'type' => 'varchar',
          'length' => 128,
        ],
        'initials' => [
          'description' => 'Forename initials for personal author',
          'type' => 'varchar',
          'length' => 128,
        ],
        'collective_name' => [
          'description' => 'Name for corporate author',
          'type' => 'varchar',
          'length' => 767,
        ],
      ],
    ];
  }

  public function getValue() {
    return $this->name;
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $last_name = $this->get('last_name')->getValue();
    $collective_name = $this->get('collective_name')->getValue();
    return empty($last_name) && empty($collective_name);
  }

}
