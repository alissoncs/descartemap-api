#limpa instalações atuais
sudo apt-get purge -y php*
sudo apt-get purge -y apache2
echo 'Removed trashes'

#update
sudo apt-get update

#vim
sudo apt-get install -y vim
echo 'Installed Vim'

#curl
sudo apt-get install -y curl

#configuracoes locale
sudo locale-gen en_US en_US.UTF-8 hu_HU hu_HU.UTF-8
sudo dpkg-reconfigure locales

#mongodb
echo "deb http://repo.mongodb.org/apt/ubuntu trusty/mongodb-org/3.0 multiverse" | sudo tee /etc/apt/sources.list.d/mongodb-org-3.0.list

sudo apt-get update
sudo apt-get install -y --force-yes mongodb-org

echo 'Installed Mongo DB'
sudo service mongod start
sudo service mongod stop
sudo service mongod restart

#php
sudo apt-get install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php5-5.6
sudo apt-get update
sudo apt-get install -y php-pear make php5-fpm php5-cli php5-gd php5-dev php5-curl php5-mcrypt
echo 'Installed PHP'

#configuring mongo
sudo pecl install mongo
sudo apt-get install -y libsasl2-dev
sudo -i
echo "extension=mongo.so" >> /etc/php5/fpm/php.ini
echo "extension=mongo.so" >> /etc/php5/cli/php.ini
echo 'Mongo configured'

#removing apache2
sudo apt-get purge apache2

sudo apt-get autoremove
sudo apt-get update

#nginx
sudo apt-get install -y nginx
echo 'Installed NGINX'
sudo apt-get autoremove

sudo service nginx stop

sudo rm -rf /etc/nginx/sites-available/default
sudo rm -rf /etc/nginx/sites-enabled/default

cd ~
echo 'server {
  listen 80 default_server;
  listen [::]:80 default_server ipv6only=on;

  root /vagrant/web;
  index index.php index.html index.htm;
  server_name localhost;
  sendfile  off;

  location / {
        # try to serve file directly, fallback to front controller
        try_files $uri /index.php$is_args$args;
        expires 0;
    }

    # If you have 2 front controllers for dev|prod use the following line instead
    # location ~ ^/(index|index_dev)\.php(/|$) {
    location ~ ^/index\.php(/|$) {
        # the ubuntu default
        fastcgi_pass   unix:/var/run/php5-fpm.sock;
        # for running on centos
        #fastcgi_pass   unix:/var/run/php-fpm/www.sock;

        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off;

        # Prevents URIs that include the front controller. This will 404:
        # http://domain.tld/index.php/some-path
        # Enable the internal directive to disable URIs like this
        # internal;
    }

    #return 404 for all php files as we do have a front controller
    location ~ \.php$ {
        return 404;
    }

    error_log /var/log/nginx/project_error.log;
    access_log /var/log/nginx/project_access.log;

}
' > tmp.conf
sudo mv tmp.conf /etc/nginx/sites-available/descartemap
sudo ln -s /etc/nginx/sites-available/descartemap /etc/nginx/sites-enabled/descartemap

sudo service nginx start

echo 'NGINX configurations end!'

sudo service php5-fpm restart
sudo service nginx restart

sudo sed -i 's/display_errors = .*/display_errors = On/g' /etc/php5/cli/php.ini
sudo sed -i 's/display_startup_errors = .*/display_startup_errors = Off/g' /etc/php5/cli/php.ini
sudo sed -i 's/display_errors = .*/display_errors = On/g' /etc/php5/fpm/php.ini
sudo sed -i 's/display_startup_errors = .*/display_startup_errors = Off/g' /etc/php5/fpm/php.ini

sudo service php5-fpm restart
sudo service mongod restart

# phpunit
cd /tmp/
wget https://phar.phpunit.de/phpunit.phar
chmod +x phpunit.phar
sudo mv phpunit.phar /usr/local/bin/phpunit
echo "Installed PHPUnit"

#composer
curl -sS https://getcomposer.org/installer | php
sudo chmod +x composer.phar
sudo mv composer.phar /usr/local/bin/composer
echo "Installed Composer"
