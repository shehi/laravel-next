#!/usr/bin/env bash
set -e

sudo chmod +x /usr/local/bin/fix-container-uid-gid.sh
sudo /usr/local/bin/fix-container-uid-gid.sh ${MYUID:-1000} ${MYGID:-1000} "$@"
id
if [ "${1#-}" != "${1}" ] || [ -z "$(command -v "${1}")" ]; then
  set -- node "$@"
fi

exec "$@"
