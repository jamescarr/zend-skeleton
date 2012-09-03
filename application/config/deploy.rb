set :application, "awesome-static"
set :repository,  "git@github.com:jamescarr/zend-skeleton.git"
set :site, "staging.example.com"

set :scm, :git
set :user, 'www-deploy'
set :deploy_to,   "/var/www/zf2tutorial/staging"
set :deploy_via, :remote_cache
set :use_sudo, false
set :deploy_subdir, "application"
ssh_options[:forward_agent] = true

role :web, site                      # Your HTTP server, Apache/etc
role :app, site                      # Your HTTP server, Apache/etc
#

namespace :composer do
  desc "run composer install and ensure all dependencies are installed"
  task :install do
      run "ln -s #{deploy_to}/vendor #{deploy_to}/current/vendor"
      run "cd #{current_path} && php composer.phar install"
  end
end

after "deploy:finalize_update", "composer:install"

