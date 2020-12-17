<?php

$json = file_get_contents('/var/www/data/boards.json');
$boards = json_decode($json, true);
foreach ($boards as $values) {
  $board = \Drupal\ebms_board\Entity\Board::create($values);
  $board->save();
}
$n = count($boards);
echo "loaded $n boards\n";
