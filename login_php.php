<?php

  $db = new PDO('sqlite:saved.sqlite') or die("cannot open the database");
  
  $er = 2;
  $qry = "select * from users";
  $result = $db->query($qry);
  
  while($row = $result->fetch(SQLITE3_ASSOC)){
    if(( $row['name'] == $_POST['user'] ) && ( $row['pass'] == $_POST['pass'] )){ 
      session_start();
      $_SESSION['user'] = $_POST['user'];
      $_SESSION['level'] = $row['level'];
      $er =1;
      break;
    }
  }

  if($er == 1)
    header("Location: http://localhost/erp/home.php");
    
  else{
    session_start();
    $_SESSION["msg"] = "The Username or Password you entered is wrong. Please try again.";
    header("Location: http://localhost/erp/login.php");
  }
?>
