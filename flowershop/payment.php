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

if (!isset( $_COOKIE["flowershop_session"])) {
	echo "<p class=\"content\">You must be logged in to view this page";
}
else{
	// does the user have a cart
	if (!isset( $_COOKIE["flowershop_cart"])) {

		echo "<p class=\"content\">Your cart is currently empty</p>\n";
	}
	else{
		// anything in cart?
		$cartid = $_COOKIE["flowershop_cart"];
		$result1 = db_query("select f.uid, f.name, f.price, c.flowerquantity from flowers f, flowercart fc, cart c where c.uid=$cartid and fc.cartid=c.uid and fc.flowerid=f.uid");
		$result2 = db_query("select a.uid, a.name, a.price, ac.quantity from arrangements a, arrangementcart ac where ac.cartid=$cartid and ac.arrangementid=a.uid");
		$nrows1 = num_rows($result1);
		$nrows2 =num_rows($result2);
		if (($nrows1==0) && ($nrows2==0)){
			echo "<p class=\"content\">Your cart is currently empty</p>\n";
		}
		else{
			// work out value and print payment info
			$total = calc_cart_total();
			echo "<p class=\"content\">Your total value of this cart is <b>$".number_format($total, 2)."</b></p>\n";
			echo "<p class=\"content\">Payment will be made with the credit card currently on file with us.  Its details are...\n";
			$session=db_query("select * from sessions where uid ='".$_COOKIE["flowershop_session"]."'");
			$srow=fetch_row($session);
			$userid=$srow["userid"];

			$quser=db_query("select * from users where uid=$userid");
			$user=fetch_row($quser);
			echo "<table>\n";
			echo "<tr><td>Card holder name</td><td> - ".$user["name"]."</td></tr>\n";
			echo "<tr><td>Card number</td><td> - ".$user["cardnumber"]."</td></tr>\n";
			echo "<tr><td>Expiry date</td><td> - ".$user["expirymonth"]."/".$user["expiryyear"]."</td></tr>\n";
			echo "</table>\n";

			echo "<p class=\"content\">Delivery will be sent to the following address...\n";
			echo "<table>\n";
			echo "<tr><td>".$user["address"]."</td></tr>\n";
			echo "</table>\n";
			echo "<br><br>";
			echo "<p class=\"content\"><a href=\"delivery.php\">Click here</a> to send payment and complete delivery\n";
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
