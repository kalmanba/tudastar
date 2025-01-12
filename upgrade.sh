#!/bin/bash

echo "Updating tudástár..."

rm -rf /var/www/learn.honaphire.net/tudastar

git clone https://github.com/kalmanba/tudastar

cp -r /var/www/learn.honaphire.net/tudastar/* /var/www/learn.honaphire.net

npm install
npm run build
composer install -n

echo "Tudástár was successfully updated!"