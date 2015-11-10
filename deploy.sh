echo "Inicializando deploy"

#limpa edições
git checkout -- .

# baixa nova versão
git pull origin master

# atualiza o composer
sudo composer update
sudo composer dump-autoload --optimize

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

# restarta os serviços
sudo service php5-fpm restart
sudo service nginx restart

echo "Deploy finalizado"