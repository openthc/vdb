<?php
/**

*/

namespace OpenTHC\VDB\Controller;

class Autocomplete extends \OpenTHC\Controller\Base
{
	/**
	 *
	 */
	function __invoke($REQ, $RES, $ARG)
	{
		// CORS
		$RES = $RES->withHeader('access-control-allow-origin', $_SERVER['HTTP_ORIGIN']);

		$q = $_GET['q'];
		if ( ! empty($_GET['term'])) {
			$q = $_GET['term'];
		}

		if (empty($q)) {
			return $RES->withJSON([], 200, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
		}

		if (strlen($q) <= 3) {
			$q = "$q%";
		} else {
			$q = "%$q%";
		}

		$sub_con = new \OpenTHC\VDB\Search();
		$res = $sub_con->search($q);

		$ret = array();
		foreach ($res['data'] as $rec) {

			$n = $rec['name'];
			if ( ! empty($rec['type'])) {
				$n.= sprintf(' (%s)', $rec['type']);
			}

			$ret[] = [
				// For jQuery Like
				'label' => $n,
				'value' => $rec['name'],
				'variety' => [
					'id' => $rec['id'],
					'name' => $rec['name'],
					'code' => $rec['code'],
					'type' => $rec['type'],
				],
			];

		}

		return $RES->withJSON($ret, 200, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

	}
}
