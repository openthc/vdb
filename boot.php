<?php
/**
 * Bootstrap Strain Database
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

define('APP_ROOT', dirname(__FILE__));

error_reporting(E_ALL & ~ E_NOTICE & ~ E_WARNING);

openlog('openthc-vdb', LOG_ODELAY|LOG_PID, LOG_LOCAL0);

require_once(APP_ROOT . '/vendor/autoload.php');

if ( ! \OpenTHC\Config::init(APP_ROOT) ) {
	_exit_html_fail('<h1>Invalid Application Configuration [VDB-029]</h1>', 500);
}

/**
 * Singular Database Connection
 */
function _dbc()
{
	static $dbc;

	if (empty($dbc)) {

		$cfg = \OpenTHC\Config::get('database/main');
		$dsn = sprintf('pgsql:host=%s;dbname=%s;user=%s;password=%s', $cfg['hostname'], $cfg['database'], $cfg['username'], $cfg['password']);

		// $dbf = sprintf('%s/var/variety.sqlite', APP_ROOT);
		// $dsn = sprintf('sqlite:%s', $dbf);

		$dbc = new \Edoceo\Radix\DB\SQL($dsn);
	}

	return $dbc;

}
