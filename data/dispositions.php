<?php

$json = file_get_contents('/var/www/data/dispositions.json');
$dispositions = json_decode($json, true);
foreach ($dispositions as $values) {
  $disposition = \Drupal\ebms_disposition\Entity\Disposition::create($values);
  $disposition->save();
}
$n = count($dispositions);
echo "loaded $n dispositions\n";
