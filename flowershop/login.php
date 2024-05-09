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

<body bgcolor=#9FB93D leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
<table width="957" height="617" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="28" background="images/leftsidefill.gif"><img src="images/spacer.gif" width="1" height="1"></td>
    <td width="755" valign="top"><table width="758" height="608" border="0" cellpadding="0" cellspacing="0">
        <tr>
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
$loginName = stripslashes($_POST["login"]);
$loginPass = stripslashes($_POST["password"]);
$result = db_query("SELECT * FROM users WHERE login='" . $loginName . "' AND password='" . $loginPass . "'");

if (num_rows($result)==0){
	echo "<p class=\"content\">Invalid login\n";
}
else{
	$row=fetch_row($result);
	$userid=$row["uid"];

	// give the user a session cookie (timout in 1 week) and transfer to userdetails page
	$result=db_query("insert into sessions values (NULL, $userid)");
	$sessionid=get_last_id();

session_start();

// Check if CSRF token exists and is not expired
if (!isset($_SESSION['csrf_token']) || $_SESSION['csrf_token_expiry'] < time()) {
    // Regenerate CSRF token and set expiry time
$_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
$_SESSION['csrf_token_expiry'] = time() + 604800; // Expiry time set to 1 week (604800 seconds)
}

$csrfToken = $_SESSION['csrf_token'];

	setcookie("flowershop_session", "$sessionid", time()+604800);
	header("Location: ".$GLOBALS["siteroot"]."userdetails.php?id=$userid");
	exit();
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
