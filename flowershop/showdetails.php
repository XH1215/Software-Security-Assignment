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

$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Connect to the database 
$conn = new mysqli("localhost", "root", "", $GLOBALS["dbname"]);

// Prepare the SQL statement
$query = "SELECT description FROM $type WHERE uid = ?";
$stmt = $conn->prepare($query);

// Bind parameters
$stmt->bind_param("s", $id);

// Execute the statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($description);

// Fetch the results
while ($stmt->fetch()) {
    echo "<div class=\"content\">" . nl2br($description) . "</div>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>




</body>
</html>
