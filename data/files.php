<?php

$json = file_get_contents('/var/www/data/files.json');
$files = json_decode($json, true);
$n = 0;
foreach ($files as $values) {
  $fid = $values['fid'];
  $basename = substr($values['uri'], 9);
  $path = "/var/www/web/sites/default/files/$basename";
  $data = file_get_contents("/var/www/data/files/file.$fid");
  if (file_put_contents($path, $data) !== FALSE) {
    $file = \Drupal\file\Entity\File::create($values);
    $file->save();
    $n++;
  }
  else {
    echo "FAILURE for $basename\n";
  }
}
echo "loaded $n files\n";
