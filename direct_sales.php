<?php  
  include "redirect.php";
  redirect();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>Direct Sales Order</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
<style type="text/css">
select{
  width:140px; 
  height:24px;
}
.suggest{
  font-size: 14px;
  border: none; 
  background-color: #EEE;
  position:fixed;
}
.suggest td{
  padding:5px 15px;
  text-align:left;
  border-bottom:1px solid #9E9E9E;
}
.high{
  cursor:pointer;
}

input[type=button], input[type=submit]{
  font-size:14px;
  padding:5px 10px;
}

.sml_txt{
  width:100px;  
}

input[type=text]{
  height:24px;
  font-size:15px;
}
select{
  height:24px;
}
.top_table th{
  padding:10px 20px 10px 30px;
  border:none;
  border-bottom:1px solid #FAFAFA;
  background-color: #424242;
  color:#FAFAFA;
  font-weight: normal;
}

table{
  border: 1px solid #424242;
  border-collapse:collapse;
}

table td, th{
  padding:10px 20px 10px 30px;
  border:none;
  border-bottom:1px solid #424242;
}

.head_row{
  background-color: #424242;
  color:#fff;
}

tbody{
  border:none;
}
body {
  font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
  background: #42413C;
  margin: 0;
  padding: 0;
  color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
  padding: 0;
  margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
  margin-top: 0;   /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
  padding-right: 15px;
  padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
  border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
  color: #42413C;
  text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
  color: #6E6C64;
  text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
  text-decoration: none;
}

/* ~~ this fixed width container surrounds all other divs ~~ */
.container {
  
  background: #FFF;
  margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
  overflow: hidden; /* this declaration makes the .container understand where the floated columns within ends and contain them */
}

/* ~~ These are the columns for the layout. ~~ 

1) Padding is only placed on the top and/or bottom of the divs. The elements within these divs have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

2) No margin has been given to the columns since they are all floated. If you must add margin, avoid placing it on the side you're floating toward (for example: a right margin on a div set to float right). Many times, padding can be used instead. For divs where this rule must be broken, you should add a "display:inline" declaration to the div's rule to tame a bug where some versions of Internet Explorer double the margin.

3) Since classes can be used multiple times in a document (and an element can also have multiple classes applied), the columns have been assigned class names instead of IDs. For example, two sidebar divs could be stacked if necessary. These can very easily be changed to IDs if that's your preference, as long as you'll only be using them once per document.

4) If you prefer your nav on the right instead of the left, simply float these columns the opposite direction (all right instead of all left) and they'll render in reverse order. There's no need to move the divs around in the HTML source.

*/
.sidebar1 {
  float: left;
  width: 180px;
  background: #EADCAE;
  padding-bottom: 10px;
}
.content {
  font: 80%/1.4;
  padding: 10px 0;
  width: 780px;
  float: left;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
  padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
  list-style: none; /* this removes the list marker */
  border-top: 1px solid #666; /* this creates the top border for the links - all others are placed using a bottom border on the LI */
  margin-bottom: 15px; /* this creates the space between the navigation on the content below */
}
ul.nav li {
  border-bottom: 1px solid #666; /* this creates the button separation */
}

ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
  padding: 5px 5px 5px 15px;
  display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */
  width: 160px;  /*this width makes the entire button clickable for IE6. If you don't need to support IE6, it can be removed. Calculate the proper width by subtracting the padding on this link from the width of your sidebar container. */
  text-decoration: none;
  background: #C6D580;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
  background: #ADB96E;
  color: #FFF;
}
ul.nav a.current{
  background-color: #558B2F;
  color: white;
}
/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
  float: right;
  margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
  float: left;
  margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the overflow:hidden on the .container is removed */
  clear:both;
  height:0;
  font-size: 1px;
  line-height: 0px;
}
.container .content table {
  text-align: center;
}
.high{
  padding:5px;
}
.high:hover{
  background-color: #424242;
  color:#eee;
}
</style>

<script language="javascript" src="loadDetails.js"></script>
<script>
var rowCounter=1;
function add_line(){
  
  var cellCounter;
  var node;
  var child2;
  var sel=<?php

            $db  = new PDO('sqlite:loc_cat.sqlite') or die("cannot open the database");

            $qry = "select * from loc";
            $result = $db->query($qry);

            echo "'";
            while($row=$result->fetch(SQLITE3_ASSOC)){
                   echo "<option>".$row['loc']."</option>";     
            }
            echo "'";
          ?>;
      
  rowCounter++;
  document.getElementById('rows').value=rowCounter;
  node = document.getElementById('add_line').insertRow(-1);
  
  child2 = node.insertCell(-1);
  child2.innerHTML="<input type=text class='sml_txt' onKeyPress='now2(event,this,1)' onBlur=hide2() name=\'a"+rowCounter+"_1\' id=\'a"+rowCounter+"_1\' autocomplete='off'><br><table class='suggest'></table>";  
  child2 = node.insertCell(-1);
  child2.innerHTML="<input type=text onKeyPress='now2(event,this,2)' onBlur='hide2()' name=\'a"+rowCounter+"_2\' id=\'a"+rowCounter+"_2\' autocomplete='off'><br><table class='suggest'></table>";
  child2 = node.insertCell(-1);
  child2.innerHTML="<input type=text name=\'a"+rowCounter+"_3\' id=\'a"+rowCounter+"_3\' onBlur='calc()' class='sml_txt'>";
  child2 = node.insertCell(-1);
  child2.innerHTML="<select name=\'a"+rowCounter+"_4\' id=\'a"+rowCounter+"_4\'></select>";
  child2 = node.insertCell(-1);
  child2.innerHTML="<input class='sml_txt' type=text name=\'a"+rowCounter+"_5\' id=\'a"+rowCounter+"_5\'>";
}

function rem_line(){
  if( rowCounter>1 ){
    rowCounter--;
    document.getElementById('rows').value=rowCounter;
    document.getElementById('add_line').deleteRow(-1);
    calc();
  }
}

function calc(){
  var i;
  var total=0;
  for ( i=1; i<=document.getElementById('rows').value; i++ ){
      total += document.getElementById("a"+i+"_3").value*document.getElementById("a"+i+"_5").value; 
  }
  document.getElementById("total").value = total;
}

</script>

</head>

<body onLoad="loadAll();">

<div class="container">
  <div class="sidebar1">
    <ul class="nav">
      <li><a href="home.php">Home</a></li>
      <li><a href="inventory.php">Current Inventory</a></li>
      <li><a href="sales_order.php" >Sales Order</a></li>
      <li><a href="direct_sales.php" class="current">Direct Sales</a></li>
      <li><a href="show_order_list.php">Order List</a></li>
      <li><a href="add_prod.php">Add Product</a></li>
      <li><a href="purchase.php">Purchase</a></li>
      <li><a href="location_main.php">Find by Location</a></li>
      <li><a href="add_category.php">Add Category</a></li>
      <li><a href="add_cust.php">Add Customer</a></li>
      <li><a href="add_supplier.php">Add Supplier</a></li>
      <li><a href="move_inventory.php">Move Inventory</a></li>
      <li><a href="executed_orders_main.php">Executed Orders</a></li>
      <li><a href="show_prods.php">View Products</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
   Use These menu options to go to the desired page on the right</div>
  <br>
  <div class="content" style="padding-left:50px;">
  <br>
  <form method="post" action="direct_sales_php.php">
    <table cellpadding="2" cellspacing="0" class="top_table">
      <tr>
        <th>Customer Name : </th>
        <td>
          <select name="cust_name" style="width:120px;">
            <?php
              $db  = new PDO('sqlite:customers.sqlite') or die("cannot open the database");
              
              $qry = "select * from customers";
              $result = $db->query($qry);
              
               while($row=$result->fetch(SQLITE3_ASSOC)){
                     echo "<option>".$row['cust_name']."</option>";     
               }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <th>Additional Details : </th>
        <td><textarea name="details" name="details" id="details" cols="45" rows="5">No Comments</textarea></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <input type="button" value="Add Item" onClick="add_line()" style="margin-right:15px;"><input type=button value="Remove Item" onClick="rem_line()">    
    <table cellpadding="5" cellspacing="0" id="add_line" style="margin-top:15px;">
      
      <tr class="head_row">
        <td>Item Code</td>
        <td>Item Name</td>
        <td>Quantity</td>
        <td>Location</td>
        <td>Price</td>
      </tr>
      
      <tr>
        <td>
          <input type="hidden" name="rows" id="rows">
          <input type="text" class='sml_txt' name="a1_1" id="a1_1" onKeyPress="now2(event, this,1)" onBlur="hide2()" autocomplete="off"><br>
          <table class="suggest" id="wow2"></table>
        </td>
        <td>
          <input type="text" name="a1_2" style="130px;" id="a1_2" onKeyPress="now2(event, this,2)" onBlur="hide2()" autocomplete="off"><br>
          <table class="suggest" id="wow"></table>
        </td>
        <td>
          <input type="text"  name="a1_3" id="a1_3" onBlur="calc()" class='sml_txt'>
        </td>
        <td>
          <select name="a1_4" id="a1_4">
          </select>
        </td>
        <td>
          <input type="text" name="a1_5" id="a1_5" class='sml_txt'>
        </td>
        
      </tr>
      
    </table>
    <br>
    <input type="submit" value="Execute Order">
    </form>
   <br>
   <div style="border:solid #424242 1px; background:#bdbdbd;padding-left:20px;">
   <br>
    Total Amount : <input type=text id="total" disabled><br>
   <br>
   </div>
  <!-- end .content --></div>
  <!-- end .container --></div>
</body>
</html>
