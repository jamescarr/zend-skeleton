set :stages, %w[staging production]
set :default_stage, 'staging'
require 'capistrano/ext/multistage'

set :application, "awesome-static"
set :repository,  "git@github.com:jamescarr/zend-skeleton.git"

set :scm, :git
set :user, 'www-deploy'
set :deploy_via, :remote_cache
set :use_sudo, false
set :deploy_subdir, "application"
ssh_options[:forward_agent] = true

set :copy_exclude, ["config/deploy*", "Capfile", "test", "README.md"]

namespace :composer do
  desc "run composer install and ensure all dependencies are installed"
  task :install do
      run "cd #{release_path} && php composer.phar self-update && php composer.phar install"
  end
end

after "deploy:finalize_update", "composer:install"

