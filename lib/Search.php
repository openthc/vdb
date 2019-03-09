<?php
/**
 * Search Interface
 */

namespace App;

class Search
{
	function __construct($c)
	{
		$this->_container = $c;
	}

	function search($q, $p=0)
	{
		$off = 0;
		$lim = 25;

		$p = intval($p);
		$p = max(1, $p);
		if ($p >= 1) {
			$p = $p - 1;
			$off = $p * $lim;
		}

		$q = trim($q);
		if (strlen($q) <= 2) {
			$q = sprintf('%s%%', $q);
		} else {
			$q = sprintf('%%%s%%', $q);
		}

		$sql = 'SELECT * FROM strain';
		$sql.= ' WHERE ';
		$sql.= ' name ILIKE :q0';
		//$sql.= ' OR full_text @@ ts_query(:q1)';
		//$sql.= ' OR
		$sql.= ' ORDER BY name';
		$sql.= sprintf(' OFFSET %d', $off);
		$sql.= sprintf(' LIMIT %d', $lim);

		$arg = array(
			':q0' => $q
		);

		$sql_max = preg_replace('/SELECT .+ FROM/', 'SELECT count(id) FROM', $sql);
		$sql_max = preg_replace('/LIMIT \d+/', null, $sql_max);
		$sql_max = preg_replace('/OFFSET \d+/', null, $sql_max);
		$sql_max = preg_replace('/ORDER BY .+/', null, $sql_max);
		$arg_max = $arg;
		//var_dump($sql_max);
		//var_dump($arg_max);

		$max = $this->_container->DB->fetchOne($sql_max, $arg_max);

		//$qry = $sdb->prepare($sql);
		//$qry->execute();
		//$qry->setFetchMode(\PDO::FETCH_ASSOC);
		//$res = $qry->fetchAll();
		//$qry->closeCursor();
		//var_dump($sql);
		//var_dump($arg);
		$res = $this->_container->DB->fetchAll($sql, $arg);

		return array(
			'page' => array(
				'max' => ceil($max / $lim),
			),
			'data' => $res
		);

	}

}
