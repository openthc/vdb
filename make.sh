#!/bin/bash
#
#

set -o errexit
set -o errtrace
set -o nounset
set -o pipefail


BIN_SELF=$(readlink -f "$0")
APP_ROOT=$(dirname "$BIN_SELF")

cd "$APP_ROOT"

composer update --no-ansi --no-dev --no-progress --quiet --classmap-authoritative

npm install --quiet >/dev/null

. vendor/openthc/common/lib/lib.sh

copy_bootstrap
copy_fontawesome
copy_jquery

#
# Tailwind
npx tailwindcss \
	--input sass/base.css \
	--output webroot/css/main.css

o=${OPENTHC_ORIGIN:-}
if [ -z "$o" ]
then
	echo "NO ORIGIN"
	# exit 1
else
	curl "$o/home" > webroot/index.html
fi
