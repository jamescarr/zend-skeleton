import 'apache'
node zenddemo {
  include vim
  include apache_server

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

  class { 'apache::php':
  }
  apache::vhost { 'my.example.com':
    priority        => '1',
    port            => '80',
    docroot         => '/var/www/html/',
    serveraliases   => ['example.com',],
  }
}
