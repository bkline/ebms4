<?php

use Drupal\ebms_document_tag\Entity\DocumentTag;

$json = file_get_contents('/var/www/data/document_tags.json');
$tags = json_decode($json, true);
foreach ($tags as $values) {
  $tag = DocumentTag::create($values);
  $tag->save();
}
$n = count($tags);
echo "loaded $n document tags\n";
