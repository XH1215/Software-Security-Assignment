<?php

/* ================================================================ */
/* functions below are common database functions used in this	    */
/* application. 						    */
/* ================================================================ */

function calc_cart_total(){

if (!isset( $_COOKIE["flowershop_cart"])) {
		// no, just print out the checkbox
		return "0.0";
	}
else{
	$cartid=$_COOKIE["flowershop_cart"];
	$ftotal = 0.00;
	$atotal = 0.00;

	// add up the flowers
	$flowers=db_query("select f.price from flowers f, flowercart fc where fc.cartid=$cartid and fc.flowerid=f.uid");
	$frow=fetch_row($flowers);
	while ($frow){
		$ftotal=$ftotal+$frow["price"];
		$frow=fetch_row($flowers);
	}
	$fqty=db_query("select * from cart where uid=$cartid");
	$f=fetch_row($fqty);
	$ftotal=$ftotal*$f["flowerquantity"];

	// add up the arrangements
	$arrangments=db_query("select a.price, ac.quantity from arrangements a, arrangementcart ac where ac.cartid=$cartid and ac.arrangementid=a.uid");
	$arow=fetch_row($arrangments);
	while ($arow){
		$atotal=$atotal+($arow["price"]*$arow["quantity"]);
		$arow=fetch_row($arrangments);
	}
	return $ftotal+$atotal;

}
}



/* ================================================================ */
/* function below are general database function and are not	    */
/* application specific.  Do not change any of the functions below  */
/* unless porting to a different RDBMS				    */
/* ================================================================ */


$lastquery = "";

// function to check that the config file is included
if (!function_exists("config")){
	print "<html><body>";
	print "<p>Cannot find configuration file.";
	print "</body></html>";
	die;
}

// connects to the database server and opens the database.  Info
// held in the config file
function open_db(){

	$h = $GLOBALS["host"];
	$u = $GLOBALS["webuser"];
	$p = $GLOBALS["webuserpasswd"];

        $dbconnecterror = FALSE;
	//if (!mysql_connect($h,$u,$p)){
        if (!mysql_connect("localhost", "root")) {
		$dbconnecterror = TRUE;
	}
	if (!mysql_select_db($GLOBALS["dbname"])){
		$dbconnecteerror = TRUE;
	}

	if ($dbconnecterror){
		// There has been an error in connecting to the sql server.  Drop an error and exit
		echo "<p>There has been an error connecting to the database.\n";
		$adm = $GLOBALS["administrator"];
		echo "<p>If this problem persists, please contact the \n";
		echo "<a href=\"mailto:$adm\">administrator</a> of this site.\n";

		return FALSE;
		exit();
	}
	else{
		return TRUE;
	}
}


// count the number of rows in this recordset
function num_rows($result){
	if ($result){
		$num = mysql_num_rows($result);

		return $num;
	}
	else{
		return 0;
	}
}

// execute a query
function db_query($querystr){
	$GLOBALS["lastquery"] = $querystr;
	$result = mysql_query($querystr);
	if (!db_error($result)){
		return $result;
	}
	else{
	 	die('Invalid query: ' . mysql_error());
	}
}


// get the value of the last auto increment number
function get_last_id(){
	return mysql_insert_id();
}

// get the next row from a query
function fetch_row($resultset){
	// returns the record as an associative array, column names
	// being the array's key
	$retval = mysql_fetch_array($resultset);
	return $retval;
}

// get the nth row from a query
function fetch_row_num($resultset,$n){
	// returns the record as an associative array, column names
	// being the array's key
	if (!mysql_data_seek($resultset,$n)){
		echo "<p>Database error:\n";
		echo "<p>Row <b>$n</b> does not exist in this resultset\n";
		exit();
	}
	$retval = mysql_fetch_array($resultset);
	return $retval;
}

// go back to the first row in a query
// fetch_row still has to be called to
// retreive the row
function rewind_recordset($resultset){
	$val =  mysql_data_seek($resultset,0);
	if (!$val){
		db_error($resultset);
	}
}

// formats a database error message
function get_db_error(){
	$errorno = mysql_errno();
	$errorstr = mysql_error();
	$retval = "Error [$errorno] $errorstr";
	return $retval;
}

function get_db_error_no(){
		return mysql_errno();
}


// if an error, write out a error message
function db_error($resultset){
	if (!$resultset){
		// Theres been a database error
		switch (get_db_error_no()){
			// could be a duplicate entry
			case 1062:
					print "<p>One or more of the fields have to have a unique entry";
					print "<p>Please <a href=\"javascript:history.go(-1)\">return</a> and correct the error";
					return TRUE;
					break;

			// might be a problem with the sql statement
			case 1064:
					print "<p>There was an error in the SQL statement";
					print "<p>SQL = ".$GLOBALS["lastquery"];
					break;

			default:
				print "<p>There was an error with the database.";
				print "<p>SQL = ".$GLOBALS["lastquery"];
				print "<p>If this problem persists, please contact the <a href=\"mailto:$adm\">administrator</a> of this site.";
				$errorstr = get_db_error();
				print "<p>$errorstr";
				break;
		}
		print "<p><p>MySQL error - ".mysql_error();
		close_db();
		exit();
		return TRUE;
	}
	else{
		return FALSE;
	}
}

// close the database
function close_db(){
	mysql_close();
}

?>

