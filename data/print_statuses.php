<?php

use Drupal\ebms_print_status\Entity\PrintStatus;

$json = file_get_contents('/var/www/data/print_statuses.json');
$statuses = json_decode($json, true);
foreach ($statuses as $values) {
  $status = PrintStatus::create($values);
  $status->save();
}
$n = count($statuses);
echo "loaded $n print statuses\n";
