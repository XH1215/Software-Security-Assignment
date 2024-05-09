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

// does the user have a cart
if (!isset( $_COOKIE["flowershop_cart"])) {
	// no
	echo "<p class=\"content\">Your cart is currently empty</p>\n";
}
else{
	$cartid = $_COOKIE["flowershop_cart"];
	$result1 = db_query("select f.uid, f.name, f.price, c.flowerquantity from flowers f, flowercart fc, cart c where c.uid=$cartid and fc.cartid=c.uid and fc.flowerid=f.uid");
	$result2 = db_query("select a.uid, a.name, a.price, ac.quantity from arrangements a, arrangementcart ac where ac.cartid=$cartid and ac.arrangementid=a.uid");
	$nrows1 = num_rows($result1);
	$nrows2 =num_rows($result2);
	if (($nrows1==0) && ($nrows2==0)){
		echo "<p class=\"content\">Your cart is currently empty</p>\n";
	}
	else{
		// go thru database and print the flowers in the cart out
		$row = fetch_row($result1);

		echo "<p class=\"content\">Your cart currently contains...</p>\n";
		echo "<br>\n";

		echo "<div style=\"overflow: auto; width: 600px; height: 300px; scrollbar-base-color: #9FB93D\">";
		$qty = $row["flowerquantity"];
		if ($nrows1>0){
			if ($qty==1){
				echo "<p class=\"content\">An arrangement consisting of...</p>\n";
			}
			else{
				echo "<p class=\"content\">$qty arrangements consisting of...</p>\n";
			}
			echo "<blockquote>\n";
			echo "<table>\n";
			while ($row){
				echo "<tr><td align=left>\n";
				echo "<p class=\"Content\">".$row["name"]."</p>\n";
				echo "</td><td>\n";
				echo "<p class=\"Content\"><img border=\"0\" src=\"uploads/flowers/".$row["uid"]."/pic.gif\">\n";
				echo " @ $".$row["price"]." each \n";
				echo "<a href=\"removeflower.php?id=".$row["uid"]."\">[remove from cart]</a></p>";
				echo "</td></tr>\n";

				$row = fetch_row($result1);
			}

			echo "</table>\n";
			echo "</blockquote>\n";
		}

		// go thru database and print the arrangements in the cart out
		if ($nrows2>0){
			$row = fetch_row($result2);
			if (num_rows($result2)>0){
				echo "<p class=\"content\">Arrangements consisting of...</p>\n";

				echo "<blockquote>\n";
				echo "<table>\n";
				while ($row){
					echo "<tr><td align=left>\n";
					echo "<p class=\"Content\">".$row["name"]."</p>\n";
					echo "</td><td>\n";
					echo "<p class=\"Content\"><img border=\"0\" src=\"uploads/arrangements/".$row["uid"]."/pic.gif\">\n";
					echo $row["quantity"]." @ $".$row["price"]." each \n";
					echo "<a href=\"removearrangement.php?id=".$row["uid"]."\">[remove from cart]</a></p>";
					echo "</td></tr>\n";

					$row = fetch_row($result2);
				}

				echo "</table>\n";
				echo "</blockquote>\n";
			}
		}

		$total = calc_cart_total();
		echo "<p align=\"center\" class=\"content\" size=\"20\">Total = $".number_format($total, 2);
		echo " <a href=\"checksession.php\">[Procede to checkout]</a>";
		echo "</div>\n";
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
