<?php

namespace Drupal\Tests\ebms_print_status\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_print_status\Entity\PrintStatus;

/**
 * Test the print status entity type.
 *
 * @group ebms
 */
class PrintStatusTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_print_status'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving a Print Status.
   */
  public function testPrintStatus() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $job_type = PrintStatus::create([
      'id' => $id,
      'label' => 'Display Name',
      'description' => 'Printing went swimmingly',
    ]);
    $job_type->save();
    $config = $this->config("ebms_print_status.status.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
