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

if (isset( $_COOKIE["flowershop_session"])) {
	$result=mysql_query("select * from sessions where uid=".$_COOKIE["flowershop_session"]);
	if (num_rows($result)!=1){
		echo "<p class=\"content\">Invalid or timed-out session, please login<br><br>\n";
?>

<table>
<form action="login.php" method="post">
<tr><td><img src="images/px.gif" width=20"></td><td><div class="content">Login</div></td><td><input name="login"></td></tr>
<tr><td><img src="images/px.gif" width=20"></td><td><div class="content">Password</div></td><td><input type="password" name="password"></td></tr>
<tr><td><img src="images/px.gif" width=20"></td><td align="right" colspan="2"><input type="submit" value="Login"></td></tr>
</table>

<?php
	}
	else{
session_start();
if (!isset($_SESSION['csrf_token'])) {
$_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];
		$row=fetch_row($result);    
		$userid=$row["userid"];
		// redirect to account page
		header("Location: ".$GLOBALS["siteroot"]."userdetails.php?id=$userid");
		exit();
	}
}
else{
	//get the user to login
?>
	<p class="content">You must login to view this page</p>

	<table>
	<form action="login.php" method="post">
    <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
	<tr><td><img src="images/px.gif" width=20"></td><td><div class="content">Login</div></td><td><input name="login"></td></tr>
	<tr><td><img src="images/px.gif" width=20"></td><td><div class="content">Password</div></td><td><input type="password" name="password"></td></tr>
	<tr><td><img src="images/px.gif" width=20"></td><td align="right" colspan="2"><input type="submit" value="Login"></td></tr>
	</table>


<?php
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
