<html>
<head>
  <title>Direct Sales</title>
</head>
<body>

<p style="padding-left:25px; font-size:16px;">Here are the details of the Sales order you just placed</p>
  
<div style="text-align:left;margin-top:30px;border:solid #424242 1px; background:#eee; align:left;padding:20px 20px 20px 25px; font-size:16px;" >
<?php
  
  if(!isset($_POST["cust_name"]) || !isset($_POST["details"]) || !isset($_POST["rows"])){
      echo "Please enter all the fields in the Form";
      exit;
  }

  $db = new PDO('sqlite:name1.sqlite') or die("cannot open the database");
  $db2 = new PDO('sqlite:executed_orders.sqlite') or die("cannot open the database");
  $db3 = new PDO('sqlite:customers.sqlite') or die("cannot open the database");
  
  $problem = 0;
  $customer_name = '\''.$_POST['cust_name'].'\'';
  $order = rand(1000000,9999999);
  $add_details = '\''.$_POST['details'].'\'';
  
  $qry = 'select * from customers where cust_name='.$customer_name.'';
  $result = $db3->query($qry);
  $row = $result->fetch(SQLITE3_ASSOC);
  
  echo "Order Number : ".$order."<br><br>Customer Name : ".$row['cust_name']."<br><br>Contact Number : ".$row['cust_number']."<br><br>Address : ".$row['cust_address'];
  
  for($i=1; $i<=$_POST['rows']; $i++){
    $var_id = 'a'.$i.'_';
  
    $qry = "select init_qty from products where code = ".$_POST[$var_id.'1']." and location='".$_POST[$var_id.'4']."'";
    $result= $db->query($qry);


    $row = $result->fetch(SQLITE3_ASSOC);
    
    if( $row['init_qty'] >= $_POST[$var_id.'3'] ){
      //check if the inventory permits it
      $qry = "update products set init_qty = ".($row['init_qty']-$_POST[$var_id.'3'])." where code=".$_POST[$var_id.'1']." and location='".$_POST[$var_id.'4']."'" ;    
      $db->query($qry);
      
      $code = $_POST[$var_id.'1'];
      $name = '\''.$_POST[$var_id.'2'].'\'';
      $qty = $_POST[$var_id.'3'];
      $loc = '\''.$_POST[$var_id.'4'].'\'';
      $price = $_POST[$var_id.'5'];

      $qry = 'insert into executed_order(cust_name, order_no,add_details,code, name, qty, location, price) values('.$customer_name.','.$order.','.$add_details.','.$code.','. $name.','.$qty.','.$loc.','.$price.')';
      $result= $db2->query($qry);
    }
    else{
      $problem++;
      continue; 
    }
  }
  echo "</div>";
  if($problem > 0){
    echo "<br><h3>Your order was processed but some items could not be put to sale because of insufficient inventory. Please have a look at the <a href='executed_orders_main.php'>Executed Orders</a> list to see what was executed.</h3>";
  }  
?>

<br><br>
<a href="direct_sales.php">Go back to Placing Orders</a>
</body>
</html>
