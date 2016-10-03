<?php

  session_start();
  if($_SESSION['level']=='admin'){
    
    if( ( !isset($_POST["user"]) || strlen($_POST["user"])==0 ) || 
    ( !isset($_POST["pass"]) || strlen($_POST["pass"])==0 ) ||
    ( !isset($_POST["level"]) || strlen($_POST["level"])==0 ) ){
      header("Location: http://localhost/erp/add_another.php");      
    }

    $db  = new PDO('sqlite:saved.sqlite') or die("cannot open the database");
    
    $qry = "select * from users";
    $result = $db->query($qry);
    
    $found = 0;
    while($row=$result->fetch(SQLITE3_ASSOC)){
      if( $row['name']== $_POST['user']){
        $found++;
        break;
      }
    }
    
    if($found>0){
      $_SESSION["msg"] = "The username already exists. Please try another one.";
      header("Location: http://localhost/erp/add_another.php");
    }
    
    else{
      $qry = "insert into users values('".$_POST['user']."','".$_POST['pass']."','".$_POST['level']."')";  
      $db->query($qry);  
      $_SESSION["msg"] = "The user has been added.";
      header("Location: http://localhost/erp/add_another.php");
    }
  
  }
  
  else{
    $_SESSION["msg"] = "You don't have sufficient privileges to do this.";
    header("Location: http://localhost/erp/add_another.php");
  }
    
?>
