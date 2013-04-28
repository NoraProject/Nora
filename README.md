Nora
====

Nora PHP FrameWork

国産フレームワーク

apt-get remove php5*
add-apt-repository ppa:ondrej/php5
apt-get update
apt-get install php5

開発環境の構築
===
    pear channel-discover pear.phpunit.de
    pear install pear.phpunit.de/PHPUnit
    pecl install xdebug
    vi /etc/php5/mods-available/xdebug.ini
    zend_extension="/usr/lib/php5/20100525/xdebug.so"
    sudo ln -s  /etc/php5/mods-available/xdebug.ini  /etc/php5/conf.d/20-xdebug.ini
    pear config-set auto_discover 1
    pear install pear.apigen.org/apigen
    apigen --source library --exclude "*Zend*" --destination doc/apigen --title "Nora Project"
