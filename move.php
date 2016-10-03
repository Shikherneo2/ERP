<?php

  if( !isset($_POST['code']) || strlen($_POST['code']) == 0  || !isset($_POST['from_loc']) || strlen($_POST['from_loc']) == 0 || !isset($_POST['qty']) || strlen($_POST['qty']) == 0 || !isset($_POST['location']) || strlen($_POST['location']) == 0){
    echo "<h3>Please enter all the details and try again.</h3>";
    echo "<br><a href='move_inventory.php'>Go back to Moving inventory</a>";
    exit();
  }

  $db = new PDO('sqlite:name1.sqlite') or die("cannot open the database");
    
  $result2 = $db->query("SELECT * FROM products WHERE code=".$_POST['code']." and location='".$_POST['from_loc']."'");
  $row = $result2->fetch(SQLITE3_ASSOC);
  
  if($row['init_qty'] >= $_POST['qty']){
    $name = '\''.$row['name'].'\'';
    $code = $row['code'];
    $category = '\''.$row['category'].'\'';
    $desc = '\''.$row['desc'].'\'';
    $remarks = '\''.$row['remarks'].'\'';
    $price = $row['price'];
    $init_qty = $_POST['qty'];
    $location = '\''.$_POST['location'].'\'';

    $er = "UPDATE products SET init_qty=".($row['init_qty']-$_POST['qty'])." WHERE CODE=".$_POST['code']." and location='".$_POST['from_loc']."' collate nocase";
    
    $db->query($er);
    
    $result2 = $db->query("SELECT * FROM products WHERE code=".$_POST['code']." and location='".$_POST['location']."' collate nocase");
    
    if( $row = $result2->fetch(SQLITE3_ASSOC) ){
      $er = "UPDATE products SET init_qty=".($row['init_qty']+$_POST['qty'])." WHERE CODE=".$_POST['code']." and location=".$location." collate nocase";
      $der=$db->query($er);
    }
    else{
      $qry = 'insert into products values('.$code.','. $name.','.$category.','.$desc.','.$remarks.','.$price.','.$init_qty.','.$location.')';
      $db->query($qry);  
    }

    $result2 = $db->query("SELECT * FROM products");

    $dom = new DOMDocument('1.0', 'utf-8');
    $dom->formatOutput = true;

    //root
    $element = $dom->createElement('top');
    $dom->appendChild($element);

    while($row = $result2->fetch(SQLITE3_ASSOC)){
        
        $element2 = $dom->createElement('product');
        $element->appendChild($element2);
          
        $element3 = $dom->createElement('code',$row['code']);
        $element2->appendChild($element3);
        
        $element3 = $dom->createElement('name',$row['name']);
        $element2->appendChild($element3);
        
        $element3 = $dom->createElement('category',$row['category']);
        $element2->appendChild($element3);
        
        $element3 = $dom->createElement('desc',$row['desc']);
        $element2->appendChild($element3);
        
        $element3 = $dom->createElement('remarks',$row['remarks']);
        $element2->appendChild($element3);
        
        $element3 = $dom->createElement('price',$row['price']);
        $element2->appendChild($element3);
        
        $element3 = $dom->createElement('init_qty',$row['init_qty']);
        $element2->appendChild($element3);
        
        $element3 = $dom->createElement('location',$row['location']);
        $element2->appendChild($element3);
    }

    $dom->save("products.xml");

    echo "<h3>The item was moved.</h3>";       
  }
  else{
    echo "<h3>Sorry the location only has ".$row['init_qty']." units of the product. So the inventory cant be moved.";
  }
  echo "<br><a href='move_inventory.php'>Go back to Moving inventory</a>";
?>
