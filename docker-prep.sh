#!/bin/sh

php artisan config:clear
cd storage

find . -type d -exec chmod 777 {} \;
find . -type f -exec chmod 666 {} \;
