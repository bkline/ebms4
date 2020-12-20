DRUSH=/var/www/vendor/bin/drush
DBURL=mysql://ebms:ebms@db/ebms
DATA=/var/www/data

rm -rf /var/www/web/sites/default/files/*
$DRUSH si -y --site-name EBMS --account-pass=pdq5ecre7 --db-url=$DBURL
$DRUSH en ebms_config
$DRUSH en ebms_article_state_type
$DRUSH en ebms_article_tag_type
$DRUSH en ebms_cycle
$DRUSH en ebms_disposition
$DRUSH en ebms_import_disposition
$DRUSH en ebms_internal_tag
$DRUSH en ebms_board
$DRUSH scr --script-path=$DATA users
$DRUSH scr --script-path=$DATA files
$DRUSH scr --script-path=$DATA cycles
$DRUSH scr --script-path=$DATA states
$DRUSH scr --script-path=$DATA tags
$DRUSH scr --script-path=$DATA boards
$DRUSH scr --script-path=$DATA dispositions
$DRUSH scr --script-path=$DATA import_dispositions
$DRUSH scr --script-path=$DATA internal_tags
