<?php

use Drupal\ebms_print_job_type\Entity\PrintJobType;

$json = file_get_contents('/var/www/data/print_job_types.json');
$types = json_decode($json, true);
foreach ($types as $values) {
  $type = PrintJobType::create($values);
  $type->save();
}
$n = count($types);
echo "loaded $n print job types\n";
