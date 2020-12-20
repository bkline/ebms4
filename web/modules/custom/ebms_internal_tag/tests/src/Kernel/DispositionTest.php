<?php

namespace Drupal\Tests\ebms_internal_tag\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_internal_tag\Entity\InternalTag;

/**
 * Test the internal tag value type.
 *
 * @group ebms
 */
class TagTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_internal_tag'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving an internal tag value.
   */
  public function testInternalTag() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $tag = InternalTag::create([
      'id' => $id,
      'label' => 'Display Name',
      'active' => TRUE,
    ]);
    $tag->save();
    $config = $this->config("ebms_internal_tag.tag.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
