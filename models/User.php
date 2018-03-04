<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 22:17
 */

namespace Models;
if(!defined('APP')) die();

class User extends Model
{
    protected $table='users';

    protected $keys=['id', 'username', 'email'];

    public $id=0;

    public $username='guest';

    public $email='';

    public $password='';


	/**
	 * User constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}
	public function get($key='', $value='')
	{
    	if ($key!=='' && $value!=='' && in_array($key, $this->keys))
        {
	        $query           = 'SELECT * FROM '.$this->table.' WHERE '.$key.' = :value';
	        $this->statement = $this->pdo->prepare($query);
	        $this->statement->bindValue(':value', $value, \PDO::PARAM_STR);
	        if ($this->statement->execute())
	        {
		        if($result = $this->statement->fetchObject('Models\User'))
		        {
		        	return $result;
		        }
	        }
	        unset($this->statement);
        }
        return $this;
    }
}