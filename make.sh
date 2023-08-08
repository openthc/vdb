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

# mkdir -p webroot/vendor

mkdir -p webroot/vendor/jquery/
cp node_modules/jquery/dist/jquery.min.js webroot/vendor/jquery/jquery.min.js

mkdir -p webroot/vendor/jquery-ui/
cp node_modules/jquery-ui/dist/themes/base/jquery-ui.min.css webroot/vendor/jquery-ui/jquery-ui.min.css
cp node_modules/jquery-ui/dist/jquery-ui.js webroot/vendor/jquery-ui/jquery-ui.js

# Bootstrap
mkdir -p webroot/vendor/bootstrap/
cp ./node_modules/bootstrap/dist/css/bootstrap.min.css webroot/vendor/bootstrap/
cp ./node_modules/bootstrap/dist/css/bootstrap.min.css.map webroot/vendor/bootstrap/
cp ./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js webroot/vendor/bootstrap/

# font awesome
mkdir -p webroot/vendor/fontawesome/css webroot/vendor/fontawesome/webfonts
cp node_modules/@fortawesome/fontawesome-free/css/all.min.css webroot/vendor/fontawesome/css/
cp node_modules/@fortawesome/fontawesome-free/webfonts/* webroot/vendor/fontawesome/webfonts/
