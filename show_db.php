<html><head><title>Manage Database</title>
</head><body>
<form method=post action="delete_db.php">
<table border=1 cellpadding="7px">
<?php

$db  = new PDO('sqlite:name1.sqlite') or die("cannot open the database");

$result2=$db->query("SELECT * FROM db_main");

while($row=$result2->fetch(SQLITE_ASSOC)){
      
      echo '<tr><td><input type=checkbox name=\'a'.$row['code'].'\'></td><td>'.
      $row['name'].'</td><td>'.$row['code'].'</td><td>'.$row['category'].'</td><td>'.$row['tags'].'</td><td>'.$row['desc'].'</td><td>'.$row['remarks'].'</td><td>'.$row['price'].'</td><td>'.$row['min_qty'].'</td></tr>';
}

//header("Location: http://shubhexpo.com/erpnew/product-page.html");
?>
</table>
<br><br>
<input type=submit value="Delete Selected">
</form>
</body><html>
