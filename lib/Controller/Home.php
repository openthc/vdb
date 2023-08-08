<?php
/**
 * Home
 */

namespace OpenTHC\VDB\Controller;

class Home extends \OpenTHC\Controller\Base
{
	/**
	 *
	 */
	function __invoke($REQ, $RES, $ARG)
	{
		$data = [];
		$data['Page'] = [
			'title' => 'Variety Database'
		];
		$html = $this->render('home.php', $data);
		return $RES->write( $html );
	}

}
