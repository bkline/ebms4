<?php

$json = file_get_contents('/var/www/data/cycles.json');
$cycles = json_decode($json, true);
foreach ($cycles as $values) {
  $cycle = \Drupal\ebms_cycle\Entity\Cycle::create($values);
  $cycle->save();
}
$n = count($cycles);
echo "loaded $n cycles\n";
