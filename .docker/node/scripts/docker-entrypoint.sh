#!/usr/bin/env bash
set -e

sudo chmod +x ./"$(dirname "$0")"/fix-container-uid-gid.sh
sudo ./"$(dirname "$0")"/fix-container-uid-gid.sh ${MYUID:-1000} ${MYGID:-1000} "$@"
id
if [ "${1#-}" != "${1}" ] || [ -z "$(command -v "${1}")" ]; then
  set -- node "$@"
fi

cd frontend
npm install

exec "$@"
