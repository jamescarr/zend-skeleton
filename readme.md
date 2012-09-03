# Zend Framework Skeleton (with Vagrant)
Vagrant box based setup that installs a virtual machine running CentOS
configured with 

* apache
* php
* mysql
      
and setup with /var/www/html mapped to a zend framework 2 application.
This project is the result of me following the stock [Zend Framework
2
Tutorial](http://zf2.readthedocs.org/en/latest/user-guide/overview.html).

## Using

- install [vagrant](http://www.vagrantup.com)
- clone this repo 

```bash

git clone git@github.com:jamescarr/zend-skeleton.git)

```
- type vagrant up
- navigate to http://192.168.50.4/
- profit!

Optionally you may map the ip to a host name in your /etc/hosts file,
for example http://local.example.com. You can do this by running
something like:

```bash
sudo echo '192.1168.50.4 local.example.com' >> /etc/hosts

```

## Multiple Environments
* my.example.com is for local dev (make changes and see the result right
away)
* staging.example.com is for testing cap staging deploys
* prod.example.com is for testing prod deploys


## Dependencies
This project has the following external dependencies 

### Gems
* capstrano - for awesome deployments
* capistrano-ext - for multiple environments
* railsless-deploy - no rails plz. kthxbye.


## More...
* [ZF2
Documentation](http://zf2.readthedocs.org/en/latest/index.html#userguide)
