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

if ($_FILES['picfile'] == "none"){
	echo "	<p>You must supply a picture to upload.\n";
	exit;
}

if ($_FILES['picfile']['type'] != "image/gif"){
		echo "<p>Picture file must be a gif document";
		exit;
}

$result = db_query("insert into arrangements values(NULL,'".$_POST['arrangementname']."', '".$_POST["description"]."',".$_POST['price'].")");
if (!$result){
    // the shared code will write an error if there was one.
    exit;
}

$lastid = get_last_id();

// create upload directory for this flower 
$GLOBALS["uploaddir"]="C:/xampp/htdocs/flowershop/uploads";
$newdir = $GLOBALS["uploaddir"]."/arrangements/".$lastid;
echo "<p>-- attempting to create $newdir";
if (!mkdir($newdir,0777)){
	echo "<p>Could not create upload directory.\n";
	$result = db_query("delete from arrangements where uid = $lastid");
	exit;
}

// copy the picture file into the directory
$fpic = $newdir."/"."pic.gif";
echo "<p>-- attempting to copy ".$_FILES['picfile']['tmp_name']." to $fpic";
if (!copy($_FILES['picfile']['tmp_name'], $fpic)){
	// remove the files
	deldir($newdir);
	
	// write an error message
	echo "<p>The picture file was not saved correctly.\n";
    exit;
}

?>
<p>Everything saved!
</body>
</html>
