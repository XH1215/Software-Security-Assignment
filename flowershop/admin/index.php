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




<p> <a href="addflower.php">Add flower</a></p>
<p> <a href="addarrangement.php">Add arrangement</a></p>
<hr>
<p><b>Housekeeping</b><p>
<p> <a href="clearusers.php">Clear users</a> (should clear sessions and carts after this operation)</p>
<p> <a href="clearsessions.php">Clear sessions</a></p>
<p> <a href="clearcarts.php">Clear carts</a></p>
<p> <a href="clearguestbook.php">Clear guestbook</a></p>
</body>
</html>
