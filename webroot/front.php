<?php
/**
 * Front Controller
 */

require_once(dirname(dirname(__FILE__)) . '/boot.php');

// See Below
$cfg = array('debug' => true);
$app = new \OpenTHC\App($cfg);

$con = $app->getContainer();
$con['DB'] = function() {

	$cfg = \OpenTHC\Config::get('database_main');

	return new \Edoceo\Radix\DB\SQL(sprintf('pgsql:dbname=%s', $cfg['database']), $cfg['username'], $cfg['password']);
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
