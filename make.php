#!/usr/bin/php
<?php
/**
 * Make Helper
 */

use OpenTHC\Make;

if ( ! is_file(__DIR__ . '/vendor/autoload.php')) {
	$cmd = [];
	$cmd[] = 'composer';
	$cmd[] = 'install';
	$cmd[] = '--classmap-authoritative';
	$cmd[] = '2>&1';
	echo "Composer:\n";
	passthru(implode(' ', $cmd), $ret);
	var_dump($ret);
}

require_once(__DIR__ . '/boot.php');

$doc = <<<DOC
OpenTHC Directory Make Helper

Usage:
	make [options]

Commands:
	install
DOC;
// $cli_args

Make::composer();

Make::npm();

Make::install_bootstrap();

Make::install_fontawesome();

Make::install_jquery();

#
# Tailwind
$cmd = [];
$cmd[] = 'npx tailwindcss';
$cmd[] = '--input sass/base.css';
$cmd[] = '--output webroot/css/main.css';
$cmd[] = '2>&1';
$cmd = implode(' ', $cmd);
echo shell_exec($cmd);
echo "\n";

create_homepage();

/**
 *
 */
function create_homepage() {

	$cfg = \OpenTHC\Config::get('openthc/vdb/origin');
	$url = sprintf('%s/home', $cfg);
	$req = _curl_init($url);
	$res = curl_exec($req);
	$inf = curl_getinfo($req);
	if (200 == $inf['http_code']) {
		$file = sprintf('%s/webroot/index.html', APP_ROOT);
		$data = $res;
		file_put_contents($file, $data);
	}

}
