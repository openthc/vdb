<?php
/**
 * Search Strains
 */

namespace App\Controller;

//use Edoceo\Radix\DB\SQL;

class Search extends \OpenTHC\Controller\Base
{
	function __invoke($REQ, $RES, $ARG)
	{

		// OR link_allbud IS NOT NULL
		//$sql.= ' WHERE (link_leafly IS NOT NULL OR link_wikileaf IS NOT NULL OR link_kannapedia IS NOT NULL)';
		//$sql.= ' WHERE vote = 0';
		//$sql.= ' WHERE vote = 1';
		$sql.= ' WHERE vote >= 2';
		//$sql.= ' WHERE vote >= 3';
		//$sql.= ' WHERE vote = 4';
		//$sql.= ' WHERE vote = 5';
		$sql.= ' ORDER BY name';

		$S = new \App\Search($this->_container);
		$res = $S->search($_GET['q'], $_GET['p']);

		$data = array(
			'Page' => array('title' => 'Strain List'),
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
		$sql.= ' FROM strain';
		$sql.= ' GROUP BY k';
		$sql.= ' ORDER BY k';
		$res = $this->_container->DB->fetchAll($sql);
		foreach ($res as $rec) {
			$k = $rec['k'];
			if (preg_match('/^[a-z]$/', $k)) {
				$data['search_pick'][$k] += $rec['v'];
			} else {
				$data['search_pick']['#'] += $rec['v'];
			}
		}

		return $this->_container->view->render($RES, 'page/strain-list.html', $data);

	}
}
