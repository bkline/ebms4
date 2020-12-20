<?php

namespace Drupal\Tests\ebms_print_job_type\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_print_job_type\Entity\PrintJobType;

/**
 * Test the print job type entity type.
 *
 * @group ebms
 */
class PrintJobTypeTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_print_job_type'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving a print job type.
   */
  public function testPrintJobType() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $job_type = PrintJobType::create([
      'id' => $id,
      'label' => 'Display Name',
      'description' => 'Fancy printing job',
    ]);
    $job_type->save();
    $config = $this->config("ebms_print_job_type.type.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
