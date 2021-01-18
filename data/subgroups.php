<?php

$json = file_get_contents('/var/www/data/subgroups.json');
$groups = json_decode($json, true);
foreach ($groups as $values) {
  $group = \Drupal\ebms_subgroup\Entity\Subgroup::create($values);
  $group->save();
}
$n = count($groups);
echo "loaded $n subgroups\n";
