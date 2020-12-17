<?php

$json = file_get_contents('/var/www/data/users.json');
$users = json_decode($json, true);
foreach ($users as $values) {
  $user = \Drupal\user\Entity\User::create($values);
  $user->save();
}
$n = count($users);
echo "loaded $n users\n";
