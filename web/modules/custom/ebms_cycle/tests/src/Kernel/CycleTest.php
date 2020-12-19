<?php

namespace Drupal\Tests\ebms_cycle\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_cycle\Entity\Cycle;

/**
 * Test the state type.
 *
 * @group ebms
 */
class CycleTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_cycle'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving an article state type.
   */
  public function testCycle() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'december_2020';
    $state = Cycle::create([
      'id' => $id,
      'label' => 'December 2020',
      'start' => strtotime('2020-01-01'),
    ]);
    $state->save();
    $config = $this->config("ebms_cycle.cycle.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertEquals($config->get('start'), strtotime('2020-01-01'));
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
