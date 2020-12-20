<?php

use Drupal\ebms_relationship_type\Entity\RelationshipType;

$json = file_get_contents('/var/www/data/relationship_types.json');
$types = json_decode($json, true);
foreach ($types as $values) {
  $type = RelationshipType::create($values);
  $type->save();
}
$n = count($types);
echo "loaded $n relationship types\n";
