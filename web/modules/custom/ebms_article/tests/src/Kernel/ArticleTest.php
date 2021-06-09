<?php

namespace Drupal\Tests\ebms_article\Kernel;

use Drupal\Core\File\FileSystemInterface;
use Drupal\KernelTests\KernelTestBase;
use Drupal\Tests\SchemaCheckTestTrait;
use Drupal\ebms_article\Entity\Article;
use Drupal\Tests\user\Traits\UserCreationTrait;

/**
 * Test the article type.
 *
 * @group ebms
 */
class ArticleTest extends KernelTestBase {

  use UserCreationTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_article', 'user', 'file', 'system'];

  /**
   * Test saving an EBMS article.
   */
  public function testArticle() {
    // $perms = ['administer site configuration'];
    $this->installEntitySchema('ebms_article');
    $this->installEntitySchema('file');
    $this->installEntitySchema('user');
    $this->installSchema('system', ['sequences']);
    $this->installSchema('file', 'file_usage');
    $entity_type_manager = $this->container->get('entity_type.manager');
    /*
    $boards = $entity_type_manager->getStorage('ebms_board')->loadMultiple();
    $this->assertEmpty($boards);
    $board_manager = $this->createUser();
    $guidelines = 'Always do the Right Thing';
    $uri = 'public://test-loe-guidelines.doc';
    $flags = FileSystemInterface::EXISTS_REPLACE;
    $file = file_save_data($guidelines, $uri, $flags);
    $board = Board::create([
      'name' => 'Test Board',
      'manager' => $board_manager->id(),
      'loe_guidelines' => $file->id(),
    ]);
    $board->save();
    $boards = $entity_type_manager->getStorage('ebms_board')->loadMultiple();
    $this->assertNotEmpty($boards);
    $this->assertCount(1, $boards);
    foreach ($boards as $board) {
      $this->assertEquals($board->getName(), 'Test Board');
    }
    */
  }

}
