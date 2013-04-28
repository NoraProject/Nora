sudo pear channel-discover pear.phpunit.de
sudo pear install pear.phpunit.de/PHPUnit
sudo pecl install xdebug
cat <<EOF | sudo tee /etc/php5/mods-available/xdebug.ini
zend_extension="/usr/lib/php5/20100525/xdebug.so"
EOF
sudo ln -s  /etc/php5/mods-available/xdebug.ini  /etc/php5/conf.d/20-xdebug.ini
sudo pear config-set auto_discover 1
sudo pear install pear.apigen.org/apigen
cat <<EOF
apigen --source library --exclude "*Zend*" --destination doc/apigen --title "Nora Project"
EOF
