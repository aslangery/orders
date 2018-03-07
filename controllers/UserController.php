<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 23:41
 */

namespace Controllers;
if(!defined('APP')) die();
use Models\User;
use Models\Session;

class UserController
{

	/**
	 * @param \App $app
	 *
	 * @return bool
	 */
	public function login(\App $app)
    {
        if ($app->request->post['username']!==null){
        	$u=new User();
            $user=$u->get('username',$app->request->post['username']);
            if (md5($app->request->post['password'])==$user->password)
            {
            	session_start();
	            if(session_regenerate_id())
	            {
		            session_write_close();
	            	$session             = new Session();
		            $session->user_id    = $user->id;
		            $session->session_id = session_id();
		            if ($session->save())
		            {
			            $host = $_SERVER['HTTP_HOST'];
			            header('Location: http://' . $host . '/index.php?view=list&task=order.orderlist');
		            }
	            }
            }
        }
        return false;
    }


	/**
	 * @param \App $app
	 */
	public function logout(\App $app)
    {
        if($app->session->delete())
        {
            $host  = $_SERVER['HTTP_HOST'];
            session_destroy();
            header('Location: http://'.$host.'/');
        }
    }
}