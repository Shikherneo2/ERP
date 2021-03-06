<?php
	if( ( !isset($_POST["cust_name"]) || strlen($_POST["cust_name"])==0 ) ||  ( !isset($_POST["number"]) || strlen($_POST["number"])==0 ) || ( !isset($_POST["address"]) || strlen($_POST["address"])==0 ) ){
		session_start();
	    $_SESSION["msg"] = "Please fill up all the entries";

	    header("Location: http://localhost/erp/add_cust.php");   
	    exit;
	}

	$db  = new PDO('sqlite:customers.sqlite') or die("cannot open the database");
	$name = '\''.$_POST['cust_name'].'\'';
	$number = $_POST['number'];
	$address = '\''.$_POST['address'].'\'';

	if( strlen($number)>11 || !is_numeric($number) || $number[0]=="+" || $number[0]=="-") {
		session_start();
	    $_SESSION["msg"] = "Please enter a valid phone number";

	    header("Location: http://localhost/erp/add_cust.php");   
	    exit;
	}
	else{
		$qry = "select cust_name from customers where cust_name=".$name." collate nocase";
        $result = $db->query($qry);
        $customers = 0;
        while( $row = $result->fetch(SQLITE3_ASSOC) ){
          $customers++;
          break;
        }

        if($customers>0){
        	session_start();
			$_SESSION["msg"] = "A customer with that name already exists. Sorry!";

		    header("Location: http://localhost/erp/add_cust.php");
        }
        else{
			$qry = 'insert into customers values('.$name.','. $number.','.$address.')';
			$result=$db->query($qry);

			session_start();
			$_SESSION["msg"] = "The customer was added";

		    header("Location: http://localhost/erp/add_cust.php");
	    }
    }

?>

