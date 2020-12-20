<?php

use Drupal\ebms_import_disposition\Entity\ImportDisposition;

$json = file_get_contents('/var/www/data/import_dispositions.json');
$dispositions = json_decode($json, true);
foreach ($dispositions as $values) {
  $disposition = ImportDisposition::create($values);
  $disposition->save();
}
$n = count($dispositions);
echo "loaded $n import dispositions\n";
