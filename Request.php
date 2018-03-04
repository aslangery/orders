<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 28.02.2018
 * Time: 22:54
 */

class Request
{
	public $get=array();

	public $post=array();

	public $cookie=array();

	public function __construct()
	{
		$args = array(
			'username'    => array('filter'    => FILTER_SANITIZE_STRING,
			                       'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
			),
			'password'    => array('filter'    => FILTER_SANITIZE_STRING,
			                       'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
			),
			'cost'=>FILTER_VALIDATE_FLOAT,
			'e-mail'=>FILTER_VALIDATE_EMAIL,
			'view'    => array('filter'    => FILTER_SANITIZE_STRING,
			                   'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
			),
			'task'    => array('filter'    => FILTER_SANITIZE_STRING,
			                   'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
			),
		);
		$this->get=filter_input_array(INPUT_GET,$args,TRUE);
		$this->post=filter_input_array(INPUT_POST,$args,TRUE);
		$this->cookie=filter_input_array(INPUT_COOKIE,$args,TRUE);
	}
}