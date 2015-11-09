git pull origin master
composer update
composer dump-autoload --optimize
rm -rf Vagrantfile
rm -rf test