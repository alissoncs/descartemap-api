VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "ubuntu/trusty64"

  config.vm.network "forwarded_port", guest: 80, host: 4058
  config.vm.network "forwarded_port", guest: 27017, host: 40587

  config.vm.synced_folder ".", "/vagrant/", :mount_options => [ "dmode=777", "fmode=777" ], :owner => 'www-data', :group => 'www-data'

  config.vm.provision "shell", path: "vagrant.sh"

  config.vm.provider "virtualbox" do |v|
    v.memory = 512
    v.cpus = 1
  end

end
