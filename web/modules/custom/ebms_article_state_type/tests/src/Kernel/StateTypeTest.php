<?php

namespace Drupal\Tests\ebms_article_state_type\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_article_state_type\Entity\ArticleStateType;

/**
 * Test the state type.
 *
 * @group ebms
 */
class StateTypeTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_article_state_type'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving an article state type.
   */
  public function testStateType() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $state = ArticleStateType::create([
      'id' => $id,
      'label' => 'Display Name',
      'description' => 'Quo usque tandem abutere Catalina patientia nostra',
      'completed' => true,
      'active' => true,
      'sequence' => 10,
    ]);
    $state->save();
    $config = $this->config("ebms_article_state_type.state.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
