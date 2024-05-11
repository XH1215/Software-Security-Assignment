<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
require "../flowershop.conf";
require "../db_func.php";

if (!open_db()){
    die;
}


session_start();  
if (isset( $_COOKIE["flowershop_session"])) {
$sessionId = $_COOKIE["flowershop_session"];
$idIs = db_query("SELECT userid FROM sessions WHERE uid = '$sessionId'");
$row1 = fetch_row($idIs);
$userIdinSession = $row1["userid"];
if($userIdinSession !=1){
    ?>
    <h1>404 Not Found</h1>
    <p>The page you are looking for does not exist.</p>
   
<?php
 exit;}}

 else{
    ?>
    <h1>404 Not Found</h1>
    <p>The page you are looking for does not exist.</p>
   
<?php
 exit;}
 ?>
<p>Add flower 
<form action="saveflower.php" method="post" enctype="multipart/form-data">
  <table width="80%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="14%">Flower Name</td>
      <td width="86%"><input name="flowername" type="text" id="flowername"></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><input name="price" type="text" id="price" value="0.00"></td>
    </tr>
    <tr> 
      <td valign="top">Description </td>
      <td><textarea name="description" cols="60" rows="5" wrap="PHYSICAL"></textarea></td>
    </tr>
    <tr> 
      <td>Picture</td>
      <td><input name="picfile" type="file" id="picfile"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
</body>
</html>
