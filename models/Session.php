<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 16.02.2018
 * Time: 18:34
 */

namespace Models;
if(!defined('APP')) die();

class Session extends Model
{
    protected $table = 'sessions';

    public $user_id = 0;

    public $session_id = '';

    public function __construct()
    {
    	parent::__construct();
    }

	/**
     * @param string $session_id
     * @return null|object
     */
    public function get($session_id='')
    {
        if ($session_id!=='')
        {
            $query='SELECT user_id, session_id FROM '.$this->table.' WHERE session_id= :id';
            $this->statement=$this->pdo->prepare($query);
            $this->statement->bindValue(':id', $session_id,\PDO::PARAM_STR);
            if($this->statement->execute())
            {
	            if ($result = $this->statement->fetchObject('Models\Session'))
	            {
		            return $result;
	            }
            }
	        unset($this->statement);
	        return $this;
        }
    }

    /**
     * @return bool
     */
    public function save()
    {
        $query='INSERT INTO '.$this->table.'(user_id, session_id) VALUES( :user, :session)';
	    $this->statement=$this->pdo->prepare($query);
	    $this->statement->bindValue(':user', $this->user_id,\PDO::PARAM_INT);
	    $this->statement->bindValue(':session', $this->session_id, \PDO::PARAM_STR);
	    $result=$this->statement->execute();
	    unset($this->statement);
	    return $result;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $query='DELETE FROM '.$this->table.' WHERE session_id= :id';
        $this->statement=$this->pdo->prepare($query);
        $this->statement->bindParam(':id', $this->session_id, \PDO::PARAM_STR,32);
		$result=$this->statement->execute();
        unset($this->statement);
        return $result;
    }


}