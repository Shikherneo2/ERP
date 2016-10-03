<?php
  
  function redirect(){
    session_start(); 
    if( !isset($_SESSION['user']) ){
    	session_start();
	    $_SESSION["msg"] = "Please Login to continue.";
        header("Location: http://localhost/erp/login.php");
    }
  }
  
?>
