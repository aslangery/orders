<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 15.02.2018
 * Time: 12:39
 */
if(!defined('APP')) die();
?>
<div>
    <span>Текущее состояние: <b><?php echo $vars['amount'];?></b></span>
</div>
<div>
    <form method="post" action="index.php?view=account&task=expence.pay">
    <input type="text" name="cost" value="0.00"/>
    <button type="submit" >Оплатить</button>
    </form>
</div>
<table>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Order #</th>
        <th>Amount</th>
        <th>Payment day</th>
        <th>Created</th>
        <th>State</th>
        <th></th>
    </tr>

    <?php
    foreach ($vars['expences'] as $expence){    ?>
    <tr>
        <td><?php echo $expence['cost'];?></td>
        <td><?php echo $expence['payment_date'];?></td>
        <td><?php echo $expence['cost'];?></td>
        <td><?php echo $expence['cost'];?></td>
        <td><?php echo $expence['cost'];?></td>
        <td><?php echo $expence['cost'];?></td>
        <td><?php echo $expence['cost'];?></td>
        <td>
            <button>Change State</button>
            <button>Delete</button>
        </td>
    </tr>
    <?php }?>
</table>


