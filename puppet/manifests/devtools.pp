class devtools {
  service { 'iptables':
    ensure => stopped
  }
  package {'vim-enhanced':
    ensure => installed
  }
  package {'git':

    ensure => installed
  }

}

