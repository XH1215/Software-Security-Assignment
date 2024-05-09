<?php
// start server-side buffering so we can
// output cookies and re-directs
ob_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="true" -->
<head>

<title>Flo's Flowershop</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<form method="POST" action="updatedetails.php">
    <!-- Other form fields -->
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <input type="submit" value="Submit">
</form>

<body bgcolor=#9FB93D leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table width="957" height="617" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28" background="images/leftsidefill.gif"><img src="images/spacer.gif" width="1" height="1"></td>
    <td width="755" valign="top"><table width="758" height="608" border="0" cellpadding="0" cellspacing="0">
        <tr	>
          <td height="145" colspan="3"><img src="images/menu.gif" alt="Search for flowers and arrangements" width="758" height="142" border="0" usemap="#Map" href="../account.php">
            <map name="Map">
              <area shape="rect" coords="12,101,86,130" href="selectflowers.php" alt="Select flowers to purchase">
              <area shape="rect" coords="93,101,225,130" href="selectarrangements.php" alt="Select arrangements to purchase">
              <area shape="rect" coords="666,100,707,134" href="checkout.php" alt="View cart and checkout">
              <area shape="rect" coords="718,99,753,133" href="account.php" alt="View my account details">
              <area shape="rect" coords="9,11,141,88" href="index.html">
              <area shape="rect" coords="620,100,657,135" href="search.php" alt="Search for flowers and arrangements">
            </map></td>
        </tr>
        <tr>
          <td width="15" height="410"><img src="images/spacer.gif" width="1" height="1"></td>
          <td width="752" align="left" valign="top">
		    <!-- InstanceBeginEditable name="Content" -->
<?php
require "flowershop.conf";
require "db_func.php";

if (!open_db()){
	die;
}

// Function to check CSRF token validity
function checkinputs(){
	$message = "";
	$error = FALSE;
	if ($_POST["name"]==""){
		$message = $message . "<li>Invalid name</li>\n";
		$error = TRUE;
	}
	if ($_POST["address"]==""){
		$message = $message . "<li>Invalid address</li>\n";
		$error = TRUE;
	}
	if (!(($_POST["cardtype"]=="visa")||($_POST["cardtype"]!="mc")||($_POST["cardtype"]!="amex"))){
		$message = $message . "<li>Invalid card type</li>\n";
		$error = TRUE;
	}
	if (strlen($_POST["cardnumber"])!=16){
		$message = $message . "<li>Invalid card number</li>\n";
		$error = TRUE;
	}
	if (($_POST["expmonth"]<1) || ($_POST["expmonth"]>12)){
		$message = $message . "<li>Invalid expiry month</li>\n";
		$error = TRUE;
	}
	if (($_POST["expyear"]<2004) || ($_POST["expyear"]>2015)){
		$message = $message . "<li>Invalid expiry year</li>\n";
		$error = TRUE;
	}
	if ($_POST["login"]==""){
		$message = $message . "<li>Invalid login</li>\n";
		$error = TRUE;
	}
	$check = db_query("select * from users where login='".$_POST["login"]."'");
	if (num_rows($check)>0){
		$message = $message . "<li>Login is already in use</p>";
		$error = TRUE;
	}
	if ($_POST["password"]==""){
		$message = $message . "<li>Invalid password</p>";
		$error = TRUE;
	}

	if ($error){
		echo "<p class=\"content\">There were errors in the registration.  ";
		echo "Please <a href=\"javascript:history.go(-1);\">go back</a>, correct these errors and retry\n";
		echo "<div class=\"content\">\n";
		echo "<ul>\n";
		echo $message;
		echo "</ul>\n";
		echo "</div>\n";

		return FALSE;
	}
	return TRUE;
}
session_start();

function validateCSRFToken($token) {
    // Validate the token against the one stored in the session
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// check for "fake" buffer overflow
if (strlen($_POST["cardnumber"]) > 50){
	header("Location: ".$GLOBALS["siteroot"]."overflow.php");
} else if (checkinputs()) {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Validate CSRF token
        if (!isset($_POST["csrf_token"]) || !validateCSRFToken($_POST["csrf_token"])) {
            // CSRF token is invalid, handle error or redirect
            // For simplicity, we'll just redirect to an error page
            header("Location: error.php?message=An+error+occurred.");
            exit();
        } else {
            // CSRF token is valid, proceed with processing the form data
            $userid = $_POST["userid"];
            $result = db_query("update users set login='" . $_POST["login"] . "', password='" . $_POST["password"] . "', name='" . $_POST["name"] . "', address='" . $_POST["address"] . "', cardnumber='" . $_POST["cardnumber"] . "', expirymonth=" . $_POST["expmonth"] . ", expiryyear=" . $_POST["expyear"] . " where uid=$userid");
            echo "<p class=\"content\">Data saved...";
        }
    }
}
?>

            <!-- InstanceEndEditable --></td>
          <td width="20"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td height=53 colspan="3" align="left"><img src="images/logo.gif"></td>
        </tr>
      </table></td>
    <td width="218" background="images/rightsidefill.gif"><img src="images/spacer.gif" width="1" height="1"></td>
  </tr>

</table>
</body>
<!-- InstanceEnd --></html>

<?php
// flush server-side buffer
ob_end_flush()
?>
