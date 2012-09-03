
class webserver {
  include webserverAdds

  import 'apache'
  class {'apache':
  }

  class { 'apache::mod::php':
  }
  apache::vhost { 'my.example.com':
    priority      => '3',
    port          => '80',
    docroot       => '/var/www/html/public',
    override      => 'All',
  }
  php::module { [ 'mysql', 'ldap', 'pdo' ]: }
}

# for environment based deployment
class webserverAdds {
  include deployUser
  exec { 'make_staging_dir':
    command => 'mkdir -p /var/www/zf2tutorial/staging/current/public',
    path    => '/bin'
  }
  exec { 'make_prod_dir':
    command => 'mkdir -p /var/www/zf2tutorial/production/current/public',
    path    => '/bin'
  }
  apache::vhost { 'staging.example.com':
    priority      => '2',
    port          => '80',
    docroot       => '/var/www/zf2tutorial/staging/current/public',
    override      => 'All',
  }
  apache::vhost { 'prod.example.com':
    priority      => '1',
    port          => '80',
    docroot       => '/var/www/zf2tutorial/production/current/public',
    override      => 'All',
  }
  exec {'perms':
    command => 'chown apache:apache -R /var/www',
    path    =>'/bin'
  }
  exec {'perms2':
    command => 'chmod g+w -R /var/www',
    path    =>'/bin'
  }
}

class deployUser {
  # needed to create users. Don't ask.
  package{ "ruby-shadow":
    ensure   => present,
    provider => gem, 
    before => User['www-deploy']
  }
  # "password" is the password!
  user { 'www-deploy':
    ensure     => present,
    password   => '$6$5S4dhKry$kZBhdJHcGHrEdK.bnscoCi3owU4lxpuV9X.SSxlVj1cESKrXMPb9EKZn7me1ghuNMKYxZ2N7gNZeO0/sl79/p.',
    groups     => 'apache',
    managehome => true,
  }
}
