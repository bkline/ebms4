<?php

namespace Drupal\Tests\ebms_relationship_type\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_relationship_type\Entity\RelationshipType;

/**
 * Test the relationship type entity type.
 *
 * @group ebms
 */
class RelationshipTypeTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_relationship_type'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving a relationship type.
   */
  public function testRelationshipType() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $type = RelationshipType::create([
      'id' => $id,
      'label' => 'Display Name',
      'description' => 'Very cozy',
      'active' => TRUE,
    ]);
    $type->save();
    $config = $this->config("ebms_relationship_type.type.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
