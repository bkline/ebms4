<?php

namespace Drupal\Tests\ebms_import_disposition\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_import_disposition\Entity\ImportDisposition;

/**
 * Test the disposition value type.
 *
 * @group ebms
 */
class DispositionTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_import_disposition'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving a disposition value.
   */
  public function testDisposition() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $disposition = ImportDisposition::create([
      'id' => $id,
      'label' => 'Display Name',
      'description' => 'The eagle has landed',
      'active' => TRUE,
    ]);
    $disposition->save();
    $config = $this->config("ebms_import_disposition.disposition.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
