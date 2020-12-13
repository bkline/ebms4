<?php

$json = file_get_contents('/var/www/data/states.json');
$states = json_decode($json, true);
foreach ($states as $values) {
  $state = \Drupal\ebms_article_state_type\Entity\ArticleStateType::create($values);
  $state->save();
}
$n = count($states);
echo "loaded $n states\n";
