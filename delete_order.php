<?php
if(!isset($_POST["order_no_to_delete"]) || $_POST["order_no_to_delete"]=="" || $_POST["order_no_to_delete"]<=0){
	echo "dsfsdfsdf";
	header("Location: http://localhost/erp/show_order_list.php");
}
else{
	$db2 = new PDO('sqlite:sales_orders.sqlite') or die("cannot open the database");
	$qry = 'delete from sales_order where order_no='.$_POST['order_no_to_delete'];
    $result = $db2->query($qry);

    session_start();
    $_SESSION["msg"] = "Order No. ".$_POST['order_no_to_delete']." was deleted.";
	header("Location: http://localhost/erp/show_order_list.php");
}

?>