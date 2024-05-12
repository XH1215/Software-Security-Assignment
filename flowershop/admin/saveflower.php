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

$result = db_query("insert into flowers values(NULL,'".$_POST['flowername']."', '".$_POST["description"]."',".$_POST['price'].")");
if (!$result){
    // the shared code will write an error if there was one.
    exit;
}


//chuqing start
// Validate the description field
$description = isset($_POST["description"]) ? $_POST["description"] : "";
// Escape HTML special characters in the description
$description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');

// Insert into the database after escaping HTML characters
$result = db_query("insert into flowers values(NULL,'".$_POST['flowername']."', '".$description."',".$_POST['price'].")");
if (!$result) {
    // Handle database insertion failure
    exit;
}

// Set X-Frame-Options header to deny framing
header('X-Frame-Options: DENY');
//chuqing end






$lastid = get_last_id();

// create upload directory for this flower 
$newdir = $GLOBALS["uploaddir"]."/flowers/".$lastid;
echo "<p>-- attempting to create $newdir";
if (!mkdir($newdir,0777)){
	echo "<p>Could not create upload directory.\n";
	$result = db_query("delete from flowers where uid = $lastid");
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
