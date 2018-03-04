<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 04.03.2018
 * Time: 19:02
 */

namespace Models;
if(!defined('APP')) die();

class Order extends Model
{
	protected $table='orders';

	public $id=0;

	public $user='';

	public $nomer='';

	public $amount='';

	public $paid= null;

	public $created=null;

	public $state='';

	public function delete()
	{

	}

	public function changeState($newState)
	{
		$query='CALL changeState(:oid, :state)';
		$this->statement=$this->pdo->prepare($query);
		$this->statement->bindParam(':oid', $this->id, \PDO::PARAM_INT);
		$this->statement->bindParam(':state', $newState, \PDO::PARAM_INT);
		if ($this->statement->execute())
		{
			$this->statement=null;
			return true;
		}
		$this->statement=null;
		return false;
	}

	public function getList()
	{
		$query='SELECT o.id, u.email, o.nomer, o.amount, 
						o.paid, o.created, o.state as state_id, s.state  
						FROM '.$this->table.' AS o 
						LEFT JOIN users AS u ON u.id=o.user
						LEFT JOIN states AS s ON s.id=o.state';
		$this->statement=$this->pdo->prepare($query);
		if ($this->statement->execute())
		{
			$result=$this->statement->fetchAll(\PDO::FETCH_CLASS, 'Models\Order');
			$this->statement=null;
			return $result;
		}
		$this->statement=null;
		return null;
	}
}