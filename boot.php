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

require_once(APP_ROOT . '/vendor/autoload.php');

function _text_stub($x)
{
	$x = strtolower($x);
	$x = preg_replace('/[^\w\-]+/', '-', $x);
	$x = preg_replace('/\-+/', '-', $x);
	$x = trim($x, '-');
	return $x;
}
