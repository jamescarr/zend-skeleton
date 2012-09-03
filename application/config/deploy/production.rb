set :site, "prod.example.com"
set :deploy_to,   "/var/www/zf2tutorial/production"

role :app, site
role :web, site

