import 'apache'
import 'mysql'

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
    priority        => '1',
    port            => '80',
    docroot         => '/var/www/html/public',
    serveraliases   => ['example.com',],
  }
}

class db {
  class { 'mysql::server':
    config_hash       => {
      'root_password' => 'cleverpassword'
    }
  }
  mysql::db { 'shipping':
    user     => 'myuser',
    password => 'mypass',
    host     => 'localhost',
    grant    => ['all'],
  }

}
