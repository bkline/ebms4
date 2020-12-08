DRUSH=/var/www/vendor/bin/drush
DBURL=mysql://ebms:ebms@db/ebms
$DRUSH si -y --site-name EBMS --account-pass=pdq5ecre7 --db-url=$DBURL
