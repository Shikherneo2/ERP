<?php 

if( ( !isset($_POST["name"]) || strlen($_POST["name"])==0 ) || 
    ( !isset($_POST["category"]) || strlen($_POST["category"])==0 ) ||
    ( !isset($_POST["price"]) || strlen($_POST["price"])==0 ) ||
    ( !isset($_POST["init_qty"]) || strlen($_POST["init_qty"])==0 ) ||
    ( !isset($_POST["location"]) || strlen($_POST["location"])==0 ) ){
    
    echo "<center><h2>Please enter all the fields and try again.</h2><br><a href='http://localhost/erp/add_prod.php'>Go back</a></center>";
    exit();
}

else{
    $db = new PDO('sqlite:name1.sqlite') or die("cannot open the database");

    $name = '\''.$_POST['name'].'\'';
    $code = rand(100000,999999);
    $category = '\''.$_POST['category'].'\'';

    if(isset($_POST["desc"]) && strlen($_POST["desc"])>0)
        $desc = '\''.$_POST['desc'].'\'';
    else
        $desc = "''";

    if(isset($_POST["remarks"]) && strlen($_POST["remarks"])>0)
        $remarks = '\''.$_POST['remarks'].'\'';
    else
        $remarks = "''";

    $price = $_POST['price'];
    $init_qty = $_POST['init_qty'];
    $location = '\''.$_POST['location'].'\'';

    $qry = 'insert into products values('.$code.','. $name.','.$category.','.$desc.','.$remarks.','.$price.','.$init_qty.','.$location.')';
    $result=$db->query($qry);

    $result2=$db->query("SELECT * FROM products");

    $dom = new DOMDocument('1.0', 'utf-8');
    $dom->formatOutput = true;

    //root
    $element = $dom->createElement('top');
    $dom->appendChild($element);

    while($row=$result2->fetch(SQLITE3_ASSOC)){
        
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
    session_start();
    $_SESSION["msg"] = "The product has been added";
    header("Location: http://localhost/erp/add_prod.php");
}

?>
