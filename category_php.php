<?php
  if( !isset($_POST["category"]) && strlen($_POST["category"])==0 ){
    session_start();
    $_SESSION["msg"] = "Please enter a Category";

    header("Location: http://localhost/erp/add_category.html");   
    exit;
  }

  $db  = new PDO('sqlite:loc_cat.sqlite') or die("cannot open the database");
  
  $cat = "";
  $add_loc=0;
  $qry = "select * from category";
  $result = $db->query($qry);
  
  while( $row = $result->fetch(SQLITE3_ASSOC) ){
    if( strtolower( $_POST['category'] ) == strtolower( $row['category'] ) ){
      $cat = $row["category"];
      $add_loc++;
      break;
    }
  }
  
  if($add_loc==0){
    $qry = "insert into category values('".$_POST['category']."')";
    $db->query($qry);    
  }
  
  session_start();
  if($add_loc==0)
    $_SESSION["msg"] = "The category has been added";  
  else
    $_SESSION["msg"] = "There is already a category with that name - ".$cat;

  header("Location: http://localhost/erp/add_category.php");   
?>
