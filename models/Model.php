<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 27.02.2018
 * Time: 22:31
 */

namespace Models;
if(!defined('APP')) die();
class Model
{
	protected $pdo=null;

	protected $statement=null;

	/**
	 * Model constructor.
	 */
	public function __construct()
	{
		$this->pdo=new \PDO(DSN,USER,PASS);
	}
}