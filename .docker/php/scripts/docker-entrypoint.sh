#!/usr/bin/env bash
set -e

sudo chmod +x ./"$(dirname "$0")"/fix-container-uid-gid.sh
sudo ./"$(dirname "$0")"/fix-container-uid-gid.sh "$MYUID" "$MYGID" "$@"

cd backend
test ! -f .env && cp .env.example .env
php artisan key:generate
php artisan storage:link
composer install --no-interaction

docker-php-entrypoint "$@"
