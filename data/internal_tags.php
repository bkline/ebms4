<?php

use Drupal\ebms_internal_tag\Entity\InternalTag;

$json = file_get_contents('/var/www/data/internal_tags.json');
$tags = json_decode($json, true);
foreach ($tags as $values) {
  $tag = InternalTag::create($values);
  $tag->save();
}
$n = count($tags);
echo "loaded $n internal tags\n";
