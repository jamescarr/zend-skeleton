
class db {
  import 'mysql'
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
