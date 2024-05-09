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

$result=db_query("delete from users");

?>

<p>All users have been deleted.
</body>
</html>
