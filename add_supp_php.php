<?php
	if( ( !isset($_POST["supp_name"]) || strlen($_POST["supp_name"])==0 ) ||  ( !isset($_POST["number"]) || strlen($_POST["number"])==0 ) || ( !isset($_POST["address"]) || strlen($_POST["address"])==0 ) ){
		session_start();
	    $_SESSION["msg"] = "Please fill up all the entries";

	    header("Location: http://localhost/erp/add_supplier.php");   
	    exit;
	}

	$db  = new PDO('sqlite:suppliers.sqlite') or die("cannot open the database");
	$name = '\''.$_POST['supp_name'].'\'';
	$number = $_POST['number'];
	$address = '\''.$_POST['address'].'\'';

	if( strlen($number)>11 || !is_numeric($number) || $number[0]=="+" || $number[0]=="-") {
		session_start();
	    $_SESSION["msg"] = "Please enter a valid phone number";

	    header("Location: http://localhost/erp/add_supplier.php");   
	    exit;
	}
	else{
		$qry = "select supp_name from suppliers where supp_name=".$name." collate nocase";
        $result = $db->query($qry);
        $supplier = 0;
        while( $row = $result->fetch(SQLITE3_ASSOC) ){
          $supplier++;
          break;
        }

        if($supplier>0){
        	session_start();
			$_SESSION["msg"] = "A Supplier with that name already exists. Sorry!";

		    header("Location: http://localhost/erp/add_supplier.php");
        }
        else{
			$qry = 'insert into suppliers values('.$name.','. $number.','.$address.')';
			$result=$db->query($qry);

			session_start();
			$_SESSION["msg"] = "The Supplier was added";

		    header("Location: http://localhost/erp/add_supplier.php");
	    }
    }

?>


