#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
#if [ "${1#-}" != "$1" ]; then
#	set -- apache2-foreground "$@"
#fi
#
#exec "$@"

# Allow writing backup logs
chmod a+w /var/www/html/backups
chmod a+x /var/www/html/backups

exec apache2-foreground
