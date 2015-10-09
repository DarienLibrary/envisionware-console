## Darien Library Envisionware Console

A suite of tools that we use internally to manage Envisionware and run custom reports. Uses Laravel 5.1

Be sure to run a `composer update` before using this:
```
composer update
```

Optional:
```
nom install gulp
npm install gulp-install
npm install laravel-elixir
nom install bootstrap-sass
gulp
```

you're also going to want to copy `.env.example` to `.env` and add your values.
If you are going to use this in a docker container as a volume, be sure to run `docker-prep.sh` or just do:
```
php artisan config:clear
cd storage

find . -type d -exec chmod 777 {} \;
find . -type f -exec chmod 666 {} \;
```
