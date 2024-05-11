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
<?php

require "../flowershop.conf";
require "../db_func.php";

if (!open_db()){
	die;
}

$result=db_query("delete from guestbook");

?>

<p>All guestbook entries have been deleted.
</body>
</html>
