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

	/**
	 * Search
	 * @param [type] $q Query Term
	 * @param integer $p Page Offset
	 * @return [type] [description]
	 */
	function search($q, $p=0)
	{
		$off = 0;
		$lim = 25;

		$q = trim($q);

		$p = intval($p);
		$p = max(1, $p);
		if ($p >= 1) {
			$p = $p - 1;
			$off = $p * $lim;
		}

		$sql_where = array();
		$arg = array(
			':q0' => $q
		);

		if (strlen($q) <= 2) {
			if ('#' == $q) {
				// $q = sprintf(')
				$sql_where[] = 'name ~ :q0';
				$arg[':q0'] = '^[0123456789].*';
			} else {
				$sql_where[] = 'name ILIKE :q0';
				$arg[':q0'] = sprintf('%s%%', $q);
			}
		} else {
			$sql_where[] = 'name ILIKE :q0';
			$arg[':q0'] = sprintf('%%%s%%', $q);
		}

		$sql = 'SELECT * FROM strain';
		$sql.= ' WHERE ';
		$sql.= implode(' AND ', $sql_where);
		//$sql.= ' OR full_text @@ ts_query(:q1)';
		//$sql.= ' OR
		$sql.= ' ORDER BY name';
		$sql.= sprintf(' OFFSET %d', $off);
		$sql.= sprintf(' LIMIT %d', $lim);

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
