<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 21:42
 */
if(!defined('APP')) die();
use Models\Session;
use Models\User;
use Controllers\UserController;

class App
{
    protected $view='';

    public $username='guest';

    public $request;

    public $session;

    public function __construct()
    {
        $this->request=new \Request();
        $layout=$this->request->get['layout'];
        if($layout==null){
	        $this->view=$this->getView('main');
        }else{
	        $this->view=$this->getView($layout);
        }

    }

    /**
     * @param string $name
     * @param string $vars
     * @return bool|string
     */
    public static function getView($name='', $vars='')
    {
        $file='views/'.$name.'.php';
        if (file_exists($file)){
	        ob_start();
            include($file);
            $view=ob_get_contents();
            ob_end_clean();
            return $view;
        }
        return false;
    }

    /**
     * @param string $view
     * @param string $position
     */
    public function render($view='', $position='content')
    {
        $pattern='/\{\{'.$position.'\}\}/';
        $this->view=preg_replace($pattern, $view, $this->view);
    }

	/**
	 * @return bool|string
	 */
	public function response()
    {
	    $pattern='/\{\{.*\}\}/';
	    $this->view=preg_replace($pattern, '', $this->view);
    	return $this->view;
    }

	/**
	 * @return bool
	 */
	public function authorise()
    {
        $session=new Session();
        $this->session=$session->get(session_id());
        if ($this->session->session_id!=='')
        {
            return true;
        }
        return false;
    }


    public function run()
    {
        $vars='';
        if ($this->authorise()) {
            $u=new User();
            $user=$u->get('id',$this->session->user_id);
            $this->username=$user->username;
            if ($this->request->get['task'] !== null) {
                $task = $this->request->get['task'];
                $args = explode('.', $task);
                $cname = '\\Controllers\\' . ucfirst($args[0]) . 'Controller';
                $controller = new $cname;
                $method = $args[1];
                $vars = $controller->$method($this);
                $vars['username']=$this->username;
            }
            if ($this->request->get['view'] !== null) {
                $view = $this->request->get['view'];
                $this->render($this->getView($view, $vars));
                $this->render($this->getView('logout',$vars),'auth');
            }
        }
        else
        {
            if($this->request->get['task']=='user.login')
            {
                $controller=new UserController();
                $controller->login($this);
            }
            $this->render($this->getView('login'),'auth');
        }
    }
}