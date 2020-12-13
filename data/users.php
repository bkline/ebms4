<?php

$json = file_get_contents('/var/www/data/users.json');
$users = json_decode($json, true);
//$map = [];
foreach ($users as $values) {
  $user = \Drupal\user\Entity\User::create($values);
  $user->save();
  //$map[$id] = $user->id();
}
//$json = json_encode($map, JSON_PRETTY_PRINT);
//file_put_contents('/var/www/data/users-map.json');
$n = count($users);
echo "loaded $n users\n";
