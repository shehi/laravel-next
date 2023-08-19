#!/usr/bin/env bash
set -e

# this script must be called with root permissions
if [[ $(id -g php) != $2 || $(id -u php) != $1 ]]; then
    groupmod -g $2 php
    usermod -u $1 -g $2 php
fi;

cp /etc/profile /home/php/.profile
chown -R php:php /home/php
