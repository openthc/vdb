<?php
/**
 * Front Controller
 *
 * This file is part of OpenTHC Strain Database ("SDB").
 *
 * SDB is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 3
 * as published by the Free Software Foundation.
 *
 * SDB is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SDB.  If not, see <https://www.gnu.org/licenses/>.*
 */

require_once(dirname(dirname(__FILE__)) . '/boot.php');

// See Below
$cfg = array('debug' => true);
$app = new \OpenTHC\App($cfg);

$con = $app->getContainer();
$con['DB'] = function() {
	$cfg = \OpenTHC\Config::get('database_main');
	return new \Edoceo\Radix\DB\SQL(sprintf('pgsql:host=%s;dbname=%s', $cfg['hostname'], $cfg['database']), $cfg['username'], $cfg['password']);
};

// Lookup Specific Datas
$app->get('/api', 'App\Controller\API')
	->add('OpenTHC\Middleware\CORS');

// Lookup Specific Datas
$app->get('/api/autocomplete', 'App\Controller\Autocomplete')
	->add('OpenTHC\Middleware\CORS');

// Lookup Specific Datas
$app->get('/api/search', 'App\Controller\Search');

// Trusted Host query /Search to search the network
//$app->get('/search', 'Example_Search');
$app->get('/search', 'App\Controller\Search')
//	->add('Middleware_Verify_HMAC')
//	->add('Middleware_Verify_Self')
//	->add('Middleware_Verify_DNS');
	;

// Trusted Host query /Search to search the network
//$app->get('/search', 'Example_Search');
$app->get('/strain/{stub}', 'App\Controller\Strain')
//	->add('Middleware_Verify_HMAC')
//	->add('Middleware_Verify_Self')
//	->add('Middleware_Verify_DNS');
	;

$app->get('/downloads', 'App\Controller\Downloads');
$app->get('/download/{format}', 'App\Controller\Download');
$app->get('/random', 'App\Controller\Random');

$app->run();

exit(0);
