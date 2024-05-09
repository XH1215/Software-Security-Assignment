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

// has user got a session cookie
if (isset( $_COOKIE["flowershop_session"])) {
	// redirect to purchase page
	header("Location: ".$GLOBALS["siteroot"]."payment.php");
	exit();
}

else{
	$total = calc_cart_total();
	echo "<p align=\"right\" class=\"carttotal\">[Cart value $".number_format($total, 2)."]</p>"
?>
	<br>
	<p class="content">Please login or register below</p>

	<table>
	<form action="register.php" method="post">
	<tr><td><div class="content">I am a new user</div></td><td align="right"><input type="submit" value="register"></td></tr>
	</form>
	<tr><td colspan="2"><div class="content">I am a returning user</div></td></tr>
	<form action="checklogin.php" method="post">
	<tr><td><img src="images/px.gif" width=20"></td><td><div class="content">Login</div></td><td><input name="login"></td></tr>
	<tr><td><img src="images/px.gif" width=20"></td><td><div class="content">Password</div></td><td><input type="password" name="password"></td></tr>
	<tr><td><img src="images/px.gif" width=20"></td><td align="right" colspan="2"><input type="submit" value="Login"></td></tr>
	</table>
	</form>
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
