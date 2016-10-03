<?php
  
  session_start();
  if(isset($_SESSION['user'])){
    if( ( !isset($_POST["pass1"]) || strlen($_POST["pass1"])==0 ) ){
      header("Location: http://localhost/erp/change_pass.php");      
    }

    $db  = new PDO('sqlite:saved.sqlite') or die("cannot open the database");
    
    $qry = "update users set pass = '".$_POST['pass1']."' where name='".$_SESSION['user']."'"; 

    $db->query($qry);
    header("Location: http://localhost/erp/home.php");
  } 
  
  else 
    header("Location: http://localhost/erp/login.php");

?>
