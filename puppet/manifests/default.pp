import 'apache'
import 'mysql'

# php moudle from https://github.com/thias/puppet-modules/tree/master/modules/php


node zenddemo {
  include vim
  include apache_server
  include db

  service { 'iptables':
    ensure => stopped
  }
}


class vim {
  package {'vim-enhanced':
    ensure => installed
  }
}
class apache_server {
  class {'apache':
  }

  class { 'apache::mod::php':
  }
  apache::vhost { 'my.example.com':
    priority      => '1',
    port          => '80',
    docroot       => '/var/www/html/public',
    serveraliases => ['example.com',],
    override      => 'All',
  }
  php::module { [ 'mysql', 'ldap', 'pdo' ]: }
}

class db {
  class { 'mysql::server':
    config_hash       => {
      'root_password' => 'cleverpassword'
    }
  }
  mysql::db { 'zf2tutorial':
    user     => 'myuser',
    password => 'mypass',
    host     => 'localhost',
    grant    => ['all'],
    sql      => '/tmp/share/populate.sql'
  }

}
