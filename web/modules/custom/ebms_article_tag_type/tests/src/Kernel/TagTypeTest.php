<?php

namespace Drupal\Tests\ebms_article_tag_type\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_article_tag_type\Entity\ArticleTagType;

/**
 * Test the article tag type.
 *
 * @group ebms
 */
class TagTypeTest extends KernelTestBase {

  use SchemaCheckTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_article_tag_type'];

  /**
   * The typed config manager.
   *
   * @var \Drupal\Core\Config\TypedConfigManagerInterface
   */
  protected $typedConfig;

  /**
   * Test saving an article tag value.
   */
  public function testTagType() {
    $this->typedConfig = \Drupal::service('config.typed');
    $id = 'test_machine_id';
    $tag = ArticleTagType::create([
      'id' => $id,
      'label' => 'Display Name',
      'description' => 'Lorem ipsum dolor sit amet,',
      'topic_required' => true,
      'active' => true,
    ]);
    $tag->save();
    $config = $this->config("ebms_article_tag_type.tag.$id");
    $this->assertEquals($config->get('id'), $id);
    $this->assertConfigSchema($this->typedConfig, $config->getName(), $config->get());
  }

}
