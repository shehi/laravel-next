#!/usr/bin/env bash
set -e

# this script must be called with root permissions
if [[ $(id -g node) != $2 || $(id -u node) != $1 ]]; then
  groupmod -g $2 node
  usermod -u $1 -g $2 node
fi

cp /etc/profile /home/node/.profile
chown -R node:node /home/node
