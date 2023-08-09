<?php
/**
 * API Information
 *
 */

namespace OpenTHC\VDB\Controller;

class API extends \OpenTHC\Controller\Base
{
	/**
	 *
	 */
	function __invoke($REQ, $RES, $ARG)
	{
		$data = [];
		$data['Page'] = [
			'title' => 'Variety Database API'
		];

		$html = $this->render('api.php', $data);

		return $RES->write( $html );

	}

}
