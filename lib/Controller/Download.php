<?php
/**
 * Downloads
 */

namespace App\Controller;

use Edoceo\Radix\DB\SQL;

class Download extends \OpenTHC\Controller\Base
{
	function __invoke($REQ, $RES, $ARG)
	{
		switch ($ARG['format']) {
		case 'strains.csv':
			$this->sendAsXSV(',');
			break;
		case 'strains.tsv':
			$this->sendAsXSV("\t");
			break;
		case 'strains.json':
			return $this->sendAsJSON($RES);
			break;
		case 'strains.sql':
			$this->sendAsSQL();
			break;
		case 'strains.xml':
			$this->sendAsXML();
			break;
		default:
			// Not Found
			return $RES->withStatus(404);
			break;
		}
	}

	function loadStrains()
	{
		$dbc = $this->_container->DB;
		$sql = 'SELECT * FROM strain ORDER BY name';
		$res = $dbc->fetchAll($sql);
		return $res;
	}

	/**
	 * Send text/plain output using some-char separated values
	 * @param [type] $sep char, the separator
	 * @return never
	 */
	function sendAsXSV($sep)
	{
		$res = $this->loadStrains();

		header('Content-Type: text/plain');

		$csv = array();
		$csv[] = 'ID';
		$csv[] = 'Type';
		$csv[] = 'Strain';
		// $csv[] = 'Stuff';

		echo implode($sep, $csv);
		echo "\n";

		foreach ($res as $rec) {

			$csv = array();
			$csv[] = $rec['id'];
			$csv[] = sprintf('"%s"', $rec['type']);
			$csv[] = sprintf('"%s"', str_replace('"', '\\"', $rec['name']));
			// $csv[] = sprintf('"%s"', $rec['stub']);

			echo implode($sep, $csv);
			echo "\n";
		}

		exit(0);
	}

	function sendAsJSON($RES)
	{
		$res = $this->loadStrains();

		$out = array();

		foreach ($res as $rec) {
			$out[] = array(
				'id' => $rec['id'],
				'name' => $rec['name'],
				'stub' => $rec['stub'],
				'type' => $rec['type'],
			);
		}

		return $RES->withJSON($out, 200, JSON_PRETTY_PRINT);

	}

	function sendAsSQL()
	{
		$res = $this->loadStrains();

		header('Content-Type: text/plain');

		echo <<<EOS
-- Adjust for your RDBMS
CREATE TABLE strain (
	id bigserial PRIMARY KEY,
	type varchar(64) NOT NULL,
	name varchar(256) NOT NULL,
	name_code varchar(256) NOT NULL,
	stub varchar(128) NOT NULL
);
EOS;

		echo "\n";
		echo "\n";

		foreach ($res as $rec) {

			$csv = array();
			$csv[] = $rec['id'];
			$csv[] = sprintf('"%s"', $rec['type']);
			$csv[] = sprintf('"%s"', str_replace('"', '\\"', $rec['name']));

			echo 'INSERT INTO strain (id, type, name) VALUES (';
			echo implode(', ', $csv);
			echo ');';
			echo "\n";

		}

		exit(0);
	}

	function sendAsXML()
	{
		$res = $this->loadStrains();

		//header('Content-Disposition: attachment; filename=openthc-strains.xml');
		header('Content-Type: text/xml');

		echo <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<!--
	This file generated from https://sdb.openthc.com/download/strains.xml
	See https://sdb.openthc.com/ for license information
-->
<!-- <?xml-stylesheet type="text/css" href="https://sdb.openthc.org/css/xml.css"?> -->
<strains>
EOF;
		foreach ($res as $rec) {

			$rec['name'] = htmlspecialchars($rec['name'], ENT_XML1, 'utf-8');

			echo "<strain>\n";
			echo "\t<name>{$rec['name']}</name>\n";
			echo "\t<stub>{$rec['stub']}</stub>\n";
			echo "\t<type>{$rec['type']}</type>\n";
			echo "</strain>\n";
		}

		echo "</strains>\n";
		echo "\n";

		exit(0);
	}
}
