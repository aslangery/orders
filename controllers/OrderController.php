<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 04.03.2018
 * Time: 18:52
 */

namespace Controllers;

use Models\Order;

class OrderController
{
	public function orderList(\App $app)
	{
		$order=new Order();
		$orders['list']=$order->getList();
		return $orders;
	}

	public function changeState(\App $app)
	{
		$order= new Order($app->request->post['id']);
		if ($order->changeState($app->request->post['state']))
		{
			$host = $_SERVER['HTTP_HOST'];
			header('Location: http://' . $host . '/index.php?view=list&task=order.orderlist&layout=component');
		}
	}
}