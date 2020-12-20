<?php

namespace Drupal\Tests\ebms_rejection_reason\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_rejection_reason\Entity\RejectionReason;

/**
 * Test the article rejection reason type.
 *
 * @group ebms
 */
class RejectionReasonTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_rejection_reason'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving a rejection reason.
   */
  public function testRejectionReason() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $reason = RejectionReason::create([
      'id' => $id,
      'label' => 'Display Name',
      'sequence' => 2,
      'extra_info' => NULL,
      'active' => TRUE,
    ]);
    $reason->save();
    $config = $this->config("ebms_rejection_reason.reason.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
