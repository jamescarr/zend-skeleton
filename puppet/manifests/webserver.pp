
class webserver {
  import 'apache'
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
