echo "Inicializando deploy"

sudo service nginx stop
sudo service php5-fpm stop

#limpa edições
git checkout -- .

# baixa nova versão
git pull origin master

# atualiza o composer
sudo composer self-update
sudo composer install --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader

#atualiza pacotes NPM
cd web/
sudo npm install

# atualiza bower
sudo bower install --allow-root

#roda o grunt
sudo grunt default
cd ../

#remove passtas não usdas
sudo rm -rf test

#remove os caches
sudo rm -rf var/cache/*
sudo rm -rf var/twig/*

#remove os arquivos do main
sudo rm -rf Vagrantfile
sudo rm -rf .gitignore
sudo rm -rf phpunit.xml
sudo rm -rf vagrant.sh

# removendo pastas de arquivos no WEB
sudo rm -rf web/bower_components/
sudo rm -rf web/node_modules/
sudo rm -rf web/bower.json
sudo rm -rf web/package.json
sudo rm -rf web/Gruntfile.js
sudo rm -rf web/css/
sudo rm -rf web/js/

#adiciona arquivo production
touch production

#permissoes
sudo chown -R www-data:www-data .
sudo chmod -R 770 .

# restarta os serviços
sudo service php5-fpm start
sudo service nginx start

echo "Deploy finalizado"
