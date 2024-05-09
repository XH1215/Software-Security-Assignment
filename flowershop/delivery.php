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
		echo "<p class=\"content\">You do not have a shopping cart</p>\n";
	}
	else{
		$cartid = $_COOKIE["flowershop_cart"];
		$result1 = db_query("select f.uid, f.name, f.price, c.flowerquantity from flowers f, flowercart fc, cart c where c.uid=$cartid and fc.cartid=c.uid and fc.flowerid=f.uid");
		$result2 = db_query("select a.uid, a.name, a.price, ac.quantity from arrangements a, arrangementcart ac where ac.cartid=$cartid and ac.arrangementid=a.uid");
		$nrows1 = num_rows($result1);
		$nrows2 =num_rows($result2);

		if (($nrows1==0) && ($nrows2==0)){
			echo "<p class=\"content\">This cart is currently empty</p>\n";
		}
		else{
			echo "<p class=\"content\">Payment received.  Many thanks.\n";
			echo "<p class=\"content\">Here are your flowers\n";

			// go thru database and print the flowers in the cart out
			$row = fetch_row($result1);

			echo "<br>\n";

			echo "<div style=\"overflow: auto; width: 600px; height: 300px; scrollbar-base-color: #9FB93D\">";
			echo "<blockquote>";

			// 2 col table, flowers in the left, arrangements in the right
			echo "<table><tr><td valign=\"top\">";
			$qty = $row["flowerquantity"];
			if ($nrows1>0){
				echo "<table>";
				while ($row){
					// print out the correct quantity
					for ($i=1; $i<=$qty; $i++){
						echo "<tr><td align=left>\n";
						echo "<img border=\"0\" src=\"uploads/flowers/".$row["uid"]."/pic.gif\">\n";
						echo "</td></tr>\n";
					}
					$row = fetch_row($result1);
				}

				echo "</table>\n";
			}
			echo "</td><td valign=\"top\">";

			// go thru database and print the arrangements in the cart out
			if ($nrows2>0){
				$row = fetch_row($result2);
				echo "<table>\n";
				while ($row){
					$qty=$row["quantity"];
					for ($i=1; $i<=$qty; $i++){
						echo "<tr><td align=left>\n";
						echo "<img border=\"0\" src=\"uploads/arrangements/".$row["uid"]."/pic.gif\">\n";
						echo "</td></tr>\n";
					}
					$row = fetch_row($result2);
				}
				echo "</table>\n";
			}
			echo "</table>";
			echo "</blockquote>";
			echo "</div>";

			// finally, delete the cart
			$result=db_query("delete from cart where uid=$cartid");
			$result=db_query("delete from flowercart where cartid=$cartid");
			$result=db_query("delete from arrangementcart where cartid=$cartid");
			setcookie("flowershop_cart", "$cartid", time() - 3600);
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
