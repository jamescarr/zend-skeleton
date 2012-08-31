# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant::Config.run do |config|
  config.vm.box = "centos64_minimal"
  config.vm.box_url = "https://dl.dropbox.com/u/7225008/Vagrant/CentOS-6.3-x86_64-minimal.box"

  config.vm.provision :puppet do |puppet|
    puppet.manifests_path = "puppet/manifests"
    puppet.manifest_file  = "default.pp"
    puppet.module_path = "puppet/modules"
  end
  
  config.vm.host_name = 'zenddemo'
  config.vm.network :hostonly, "192.168.50.4"
  config.vm.share_folder "www", "/var/www/html/", "/home/jamescarr/Perforce/james.r.carr_caprica_james_7951/web/public"
  config.vm.share_folder "artifacts", "/tmp/share", "./share"
end
