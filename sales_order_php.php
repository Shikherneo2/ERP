<html>
<head>
  <title>Purchase/Manufacture</title>
</head>
<body>
  <p style="padding-left:25px; font-size:16px;">Here are the details of the Sales order you just saved</p>
  
  <div style="text-align:left;margin-top:30px;border:solid #424242 1px; background:#eee; align:left;padding:20px 20px 20px 25px; font-size:16px;" >
  <?php
    if(!isset($_POST["cust_name"]) || !isset($_POST["details"]) || !isset($_POST["rows"])){
      echo "Please enter all the fields in the Form";
      exit;
    }

    for($i=1; $i<=$_POST['rows']; $i++){
      $var_id = 'a'.$i.'_';

      if(!isset($_POST[$var_id.'1']) || !isset($_POST[$var_id.'2']) || !isset($_POST[$var_id.'3']) || !isset($_POST[$var_id.'4']) || !isset($_POST[$var_id.'5'])){
        echo "Please enter all the fields in the Form";
        exit;
      }
    }

    $db  = new PDO('sqlite:sales_orders.sqlite') or die("cannot open the database");
    $db2  = new PDO('sqlite:customers.sqlite') or die("cannot open the database");

    $customer_name = '\''.$_POST['cust_name'].'\'';
    $order = rand(1000000,9999999);
    $add_details = '\''.$_POST['details'].'\'';

    $qry = 'select * from customers where cust_name='.$customer_name.'';
    $result=$db2->query($qry);
    $row=$result->fetch(SQLITE3_ASSOC);

    echo "Order Number : ".$order."<br><br>Customer Name : ".$row['cust_name']."<br><br>Contact Number : ".$row['cust_number']."<br><br>Address : ".$row['cust_address'];

    for($i=1; $i<=$_POST['rows']; $i++){
      $var_id = 'a'.$i.'_';

      $code = $_POST[$var_id.'1'];
      $name = '\''.$_POST[$var_id.'2'].'\'';
      $qty = $_POST[$var_id.'3'];
      $loc = '\''.$_POST[$var_id.'4'].'\'';
      $price = $_POST[$var_id.'5'];

      $qry = 'insert into sales_order(cust_name, order_no,add_details,code, name, qty, location, price) values('.$customer_name.','.$order.','.$add_details.','.$code.','. $name.','.$qty.','.$loc.','.$price.')';
      $result= $db->query($qry);

      echo "<br><br>Item Code : ".$code."<br><br>Item Name : ".$name."<br><br>Quantity : ".$qty."<br><br>Location : ".$loc."<br><br>Price : ".$price;
    }  
  ?>
</div>
<br><br>
<a href="sales_order.php">Go back to Sales</a>
</body>
</html>
