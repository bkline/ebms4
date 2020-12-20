<?php

use Drupal\ebms_rejection_reason\Entity\RejectionReason;

$json = file_get_contents('/var/www/data/rejection_reasons.json');
$reasons = json_decode($json, true);
foreach ($reasons as $values) {
  $reason = RejectionReason::create($values);
  $reason->save();
}
$n = count($reasons);
echo "loaded $n rejection reasons\n";
