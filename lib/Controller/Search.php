<?php
/**
 * Variety Search
 */

namespace OpenTHC\VDB\Controller;

class Search extends \OpenTHC\Controller\Base
{
	/**
	 *
	 */
	function __invoke($REQ, $RES, $ARG)
	{
		$dbc = _dbc();

		$S = new \OpenTHC\VDB\Search($this->_container);
		$res = $S->search($_GET['q'], $_GET['p']);

		$data = array(
			'Page' => array('title' => 'Variety List'),
			'search_pick' => array(),
			'search_page' => array(
				'q' => $_GET['q'],
				'cur' => max(1, intval($_GET['p'])),
				'max' => $res['page']['max'],
			),
			'search_data' => $res['data'],
		);

		// Prefix Jump List
		$sql = 'SELECT lower(substr(name, 1, 1)) AS k, count(id) AS v';
		$sql.= ' FROM variety';
		$sql.= ' GROUP BY k';
		$sql.= ' ORDER BY k';
		$res = $dbc->fetchAll($sql);
		foreach ($res as $rec) {
			$k = $rec['k'];
			if (preg_match('/^[a-z]$/', $k)) {
				$data['search_pick'][$k] += $rec['v'];
			} else {
				$data['search_pick']['#'] += $rec['v'];
			}
		}

		// var_dump($data);

		$html = $this->render('search.php', $data);

		return $RES->write( $html );

	}
}
