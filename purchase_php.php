<html>
<head>
  <title>Purchase Products</title>
</head>

<body style="padding-left:25px;padding-right:25px; font-size:15px; line-height:25px;">
  <?php 
    if(!isset($_POST["supp_name"]) || !isset($_POST["details"]) || !isset($_POST["rows"])){
      echo "<h3>Please enter all the fields in the Form</h3>";
      echo "<br><a href='purchase.php'>Go back to Purchasing.</a>";
      exit;
    }
    else{
      echo "<h3>Here are the details of the products you just purchased.</h3>";
      echo '<div style="border:solid #424242 1px; background:#eee; text-align:left; padding:15px 20px 15px 20px;" >';
    }

    $db = new PDO('sqlite:name1.sqlite') or die("cannot open the database");
    $db2 = new PDO('sqlite:suppliers.sqlite') or die("cannot open the database");
    $db3 = new PDO('sqlite:purchased.sqlite') or die("cannot open the database");
    
    $supp_name = '\''.$_POST['supp_name'].'\'';
    $order = rand(1000000,9999999);
    $add_details = '\''.$_POST['details'].'\'';
    
    $qry = 'select * from suppliers where supp_name='.$supp_name.'';
    $result = $db2->query($qry);
    $row = $result->fetch(SQLITE3_ASSOC);
    
    echo "Order Number : ".$order."<br>Supplier Name : ".$row['supp_name']."<br>Contact Number : ".$row['supp_number']."<br>Address : ".$row['supp_address'];
    
    for($i=1; $i<=$_POST['rows']; $i++){
      $var_id = 'a'.$i.'_';
    
      $qry = "select init_qty from products where code = ".$_POST[$var_id.'1']." and location='".$_POST[$var_id.'4']."'";
      $result= $db->query($qry);

      $row=$result->fetch(SQLITE3_ASSOC);
      
      $qry = "update products set init_qty = ".($row['init_qty']+$_POST[$var_id.'3'])." where code=".$_POST[$var_id.'1']." and location='".$_POST[$var_id.'4']."'" ;    
      $db->query($qry);
      
      $code = $_POST[$var_id.'1'];
      $name = '\''.$_POST[$var_id.'2'].'\'';
      $qty = $_POST[$var_id.'3'];
      $loc = '\''.$_POST[$var_id.'4'].'\'';
      $price = $_POST[$var_id.'5'];

      $qry = 'insert into purchased values('.$supp_name.','.$order.','.$add_details.','.$code.','. $name.','.$qty.','.$loc.','.$price.')';
      $db3->query($qry);
      
      echo "<br>Code : ".$code."<br>Item Name : ".$name."<br>Quantity : ".$qty."<br>Location : ".$loc."<br>Price : ".$price;
         
    }  
?>
</div></body></html>
