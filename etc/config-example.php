<?php
/**
 * OpenTHC Variety Database
 */

// Init
$cfg = [];

// Database
$cfg['database'] = [
	'main' => [
		'hostname' => '127.0.0.1',
		'username' => 'openthc_main',
		'password' => 'openthc_main',
		'database' => 'openthc_main',
	],
];

$cfg['redis'] = [
	'hostname' => '127.0.0.1',
];


$cfg['openthc'] = [];

$cfg['openthc']['sso'] = [
	// 'id' => '010PENTHCX0000SVC000000SS0',
	// 'client-pk' => '',
	// 'client-sk' => '',
	'origin' => 'https://sso.openthc.example.com',
	// 'secret' => 'SK/vdb.openthc.example.com',
];

$cfg['openthc']['vdb'] = [
	'id' => '010PENTHCX0000SVC000000VDB',
	'origin' => 'https://vdb.openthc.example.com',
	'secret' => 'SK/vdb.openthc.example.com',
];

return $cfg;
