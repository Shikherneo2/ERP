<?php
  if(!isset($_POST["order"])){
    echo "<h3>Something went wrong. Please try that again.</h3><br><a href='show_order_list.php'>Go back</a>";
    exit;
  }

  $db = new PDO('sqlite:executed_orders.sqlite') or die("cannot open the database");
  $db2 = new PDO('sqlite:sales_orders.sqlite') or die("cannot open the database");
  $db3 = new PDO('sqlite:name1.sqlite') or die("cannot open the database");
  
  $qry = "select * from sales_order where order_no=".$_POST['order']; 
  
  $result = $db2->query($qry);
  $problem = 0;
  while($row=$result->fetch(SQLITE3_ASSOC)){
      
    $code = $row['code'];
    $name = '\''.$row['name'].'\'';
    $qty = $row['qty'];
    $loc = '\''.$row['location'].'\'';
    $price = $row['price'];
    
    $customer_name = '\''.$row['cust_name'].'\'';
    $order = $row['order_no'];
    $add_details = '\''.$row['details'].'\'';
    
    $qry = "select init_qty from products where code=".$code; 
    $result = $db3->query($qry);
    $row3 = $result->fetch(SQLITE3_ASSOC);
    
    if( $row3['init_qty'] >= $row['qty'] ){
      $qry = 'insert into executed_order(cust_name,order_no,add_details, code, name, qty, location,price) values('.$customer_name.','.$order.','.$add_details.','.$code.','. $name.','.$qty.','.$loc.','.$price.')';
      $result= $db->query($qry);
      
      $qry = "update products set init_qty = ".($row3['init_qty']-$row['qty'])." where code=".$row['code']." and location='".$row['location']."'" ;    
      $db3->query($qry);
       
      $qry = 'delete from sales_order where order_no='.$row['order_no'];
      $result = $db2->query($qry);
    }
    else{
      $problem++;
      continue; 
    }
}  
if($problem > 0){
  echo "<h3>Your order was processed but some items could not be put to sale because of insufficient inventory. Please have a look at the <a href='executed_orders_main.php'>Executed Orders</a> list to see what was executed.</h3>";
}
else{
 echo "<h3>Your order was was placed successfully."; 
} 
?>
<br><a href="direct_sales.php">Go back to Placing Orders</a>

