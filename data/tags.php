<?php

$json = file_get_contents('/var/www/data/tags.json');
$tags = json_decode($json, true);
foreach ($tags as $values) {
  $tag = \Drupal\ebms_article_tag_type\Entity\ArticleTagType::create($values);
  $tag->save();
}
$n = count($tags);
echo "loaded $n tags\n";
