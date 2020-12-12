DRUSH=/var/www/vendor/bin/drush
DBURL=mysql://ebms:ebms@db/ebms
DATA=/var/www/data

$DRUSH si -y --site-name EBMS --account-pass=pdq5ecre7 --db-url=$DBURL
$DRUSH en ebms_article_state_type
$DRUSH scr --script-path=$DATA states
