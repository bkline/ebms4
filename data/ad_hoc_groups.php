<?php

$json = file_get_contents('/var/www/data/ad_hoc_groups.json');
$groups = json_decode($json, true);
foreach ($groups as $values) {
  $group = \Drupal\ebms_ad_hoc_group\Entity\AdHocGroup::create($values);
  $group->save();
}
$n = count($groups);
echo "loaded $n ad-hoc groups\n";
