#!/bin/bash
#
# Install Helper
#
# SPDX-License-Identifier: GPL-3.0-only
#

set -o errexit
set -o errtrace
set -o nounset
set -o pipefail

APP_ROOT=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )

cd "$APP_ROOT"

composer install --no-ansi --no-progress --classmap-authoritative

npm install --no-audit --no-fund

php <<PHP
<?php
define('APP_ROOT', __DIR__);
require_once(APP_ROOT . '/vendor/autoload.php');
\OpenTHC\Make::install_bootstrap();
\OpenTHC\Make::install_fontawesome();
\OpenTHC\Make::install_jquery();
PHP

# lodash
# mkdir -p webroot/vendor/lodash/
# cp node_modules/lodash/lodash.min.js webroot/vendor/lodash/

# htmx
# mkdir -p webroot/vendor/htmx
# cp node_modules/htmx.org/dist/htmx.min.js webroot/vendor/htmx/

#
# Tailwind
npx tailwindcss \
	--input sass/base.css \
	--output webroot/css/main.css \
	2>&1


#
#
php <<PHP
<?php
require_once(__DIR__ . '/boot.php');
\OpenTHC\Make::create_homepage('vdb');
PHP
