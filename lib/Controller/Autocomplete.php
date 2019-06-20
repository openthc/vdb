<?php
/**

*/

namespace App\Controller;

class Autocomplete extends \OpenTHC\Controller\Base
{
	function __invoke($REQ, $RES, $ARG)
	{
		$q = $_GET['q'];
		if (!empty($_GET['term'])) {
			$q = $_GET['term'];
		}

		if (empty($q)) {
			return $RES->withJSON(array(), 200, JSON_PRETTY_PRINT);
		}

		if (strlen($q) <= 3) {
			$q = "$q%";
		} else {
			$q = "%$q%";
		}

		$sub_con = new \App\Search($this->_container);
		$res = $sub_con->search($q);

		$ret = array();
		foreach ($res['data'] as $rec) {

			$n = $rec['name'];
			if (!empty($rec['type'])) {
				$n.= sprintf(' (%s)', $rec['type']);
			}

			$ret[] = array(
				'label' => $n,
				'value' => $rec['name'],
				'strain' => array(
					'name' => $rec['name'],
					'code' => $rec['code'],
					'type' => $rec['type'],
				),
			);
		}

		return $RES->withJSON($ret, 200, JSON_PRETTY_PRINT);

	}
}
