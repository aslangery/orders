<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 15.02.2018
 * Time: 12:39
 */
if(!defined('APP')) die();
?>

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

    foreach ($vars['list'] as $order){    ?>
    <tr>
        <td><?php echo $order->id;?></td>
        <td><?php echo $order->user;?></td>
        <td><?php echo $order->nomer;?></td>
        <td><?php echo $order->amount;?></td>
        <td><?php echo $order->paid;?></td>
        <td><?php echo $order->created;?></td>
        <td><?php echo $order->state;?></td>
        <td>
            <?php
            if ($order->state_id==1){
            ?>
            <button onclick="changeState(<?php echo $order->id.', 2'?>)">Change State</button>
                <?php }?>
            <button>Delete</button>
        </td>
    </tr>
    <?php }?>
</table>
<script type="text/javascript">
function changeState(id, state)
{
    $("#list").load("index.php?task=order.changeState", {'id': id, 'state':state});
}
</script>

