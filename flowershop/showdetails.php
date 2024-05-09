<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor=#9FB93D>
<?php
require "flowershop.conf";
require "db_func.php";

if (!open_db()){
	die;
}
$result=db_query("select description from ".$_GET["type"]." where uid=".$_GET["id"]);
$row=fetch_row($result);
while($row){
	echo "<div class=\"content\">".str_replace(chr(10), "<br>", $row["description"])."</div>";
	$row=fetch_row($result);
}

?>
</body>
</html>
