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

// Lookup Specific Datas
$app->get('/', 'OpenTHC\VDB\Controller\Home');
$app->get('/home', 'OpenTHC\VDB\Controller\Home');

$app->get('/api', 'OpenTHC\VDB\Controller\API')
	->add('OpenTHC\Middleware\CORS');

// Lookup Specific Datas
$app->get('/api/autocomplete', 'OpenTHC\VDB\Controller\Autocomplete')
	->add('OpenTHC\Middleware\CORS');

// Lookup Specific Datas
$app->get('/api/search', 'OpenTHC\VDB\Controller\Search')
	->add('OpenTHC\Middleware\CORS');

// Basic Search
$app->get('/search', 'OpenTHC\VDB\Controller\Search');

// View Single Item
$app->get('/v/{stub}', 'OpenTHC\VDB\Controller\Single');

$app->get('/downloads', 'OpenTHC\VDB\Controller\Downloads');
$app->get('/download/{format}', 'OpenTHC\VDB\Controller\Download');
$app->get('/random', 'OpenTHC\VDB\Controller\Random');

$app->run();

exit(0);
