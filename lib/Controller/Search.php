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

		$S = new \OpenTHC\VDB\Search();
		$res = $S->search($_GET['q'], $_GET['p']);

		$data = array(
			'Page' => array('title' => 'Variety List'),
			'search_page' => array(
				'q' => $_GET['q'],
				'cur' => max(1, intval($_GET['p'])),
				'max' => $res['page']['max'],
			),
			'search_data' => $res['data'],
		);

		// var_dump($data);

		$html = $this->render('search.php', $data);

		return $RES->write( $html );

	}
}
