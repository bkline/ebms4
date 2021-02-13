<?php

namespace Drupal\Tests\ebms_subgroup\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\ebms_subgroup\Entity\Subgroup;
use Drupal\ebms_board\Entity\Board;

/**
 * Test the subgroup type.
 *
 * @group ebms
 */
class SubgroupTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['ebms_board', 'ebms_subgroup', 'user', 'file'];

  /**
   * Test saving a PDQ board.
   */
  public function testSubgroup() {
    $this->installEntitySchema('ebms_board');
    $this->installEntitySchema('ebms_subgroup');
    $entity_type_manager = $this->container->get('entity_type.manager');
    $subgroups = $entity_type_manager->getStorage('ebms_subgroup')->loadMultiple();
    $this->assertEmpty($subgroups);
    $name = 'Bowling Club';
    $board = Board::create(['name' => 'Test Board']);
    $board->save();
    $subgroup = Subgroup::create([
      'name' => $name,
      'board' => $board->id(),
    ]);
    $subgroup->save();
    $subgroups = $entity_type_manager->getStorage('ebms_subgroup')->loadMultiple();
    $this->assertNotEmpty($subgroups);
    $this->assertCount(1, $subgroups);
    foreach ($subgroups as $subgroup) {
      $this->assertEquals($subgroup->getName(), $name);
    }
  }

}
