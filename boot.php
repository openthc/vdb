<?php
/**
 * Bootstrap Strain Database
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
