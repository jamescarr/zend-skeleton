set :site, "staging.example.com"
set :deploy_to,   "/var/www/zf2tutorial/staging"

role :app, site
role :web, site

