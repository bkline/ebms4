<?php

namespace Drupal\Tests\ebms_document_tag\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_document_tag\Entity\DocumentTag;

/**
 * Test the document tag value entity type.
 *
 * @group ebms
 */
class DocumentTagTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_document_tag'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving a print job type.
   */
  public function testDocumentTag() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $job_type = DocumentTag::create([
      'id' => $id,
      'label' => 'Test Display Name',
      'description' => 'Very important doc',
    ]);
    $job_type->save();
    $config = $this->config("ebms_document_tag.tag.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
