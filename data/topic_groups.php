<?php

$json = file_get_contents('/var/www/data/topic_groups.json');
$groups = json_decode($json, true);
foreach ($groups as $values) {
  $group = \Drupal\ebms_topic_group\Entity\TopicGroup::create($values);
  $group->save();
}
$n = count($groups);
echo "loaded $n topic groups\n";
