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
<script language="javascript">

var win = null;

function NewWindow(mypage,myname,w,h,scroll){
   LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
   TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
   settings = 'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
   win = window.open(mypage,myname,settings)
}

function checkqty() {
   if (isNaN(document.flowersfrm.quantity.value)) {
       alert ("Invalid Format!\nMust be a number between 1-99");
       document.flowersfrm.quantity.focus();
       document.flowersfrm.quantity.select();
       return false;
   }
   else if (document.flowersfrm.quantity.value < 1 || document.flowersfrm.quantity.value > 99) {
      alert ("Invalid Format!\nMust be a number between 1-99");
      document.flowersfrm.quantity.focus();
      document.flowersfrm.quantity.select();
      return false;
   }
   return true;
}
</script>
<?php
require "flowershop.conf";
require "db_func.php";

if (!open_db()){
	die;
}

$total = calc_cart_total();
echo "<p align=\"right\" class=\"carttotal\">[Cart value $".number_format($total, 2)."]</p>";

?>
            <p class="Content">Select the type of flowers you would like in your
              arangment. To see further details on any flower, click its image</p>
			<form name="flowersfrm" action="buyflowers.php" method="post" onsubmit="return checkqty();">
			<table width="400" align="center">
              <tr>
                <td>
                  <div style="overflow: auto; width: 400px; height: 200px; scrollbar-base-color: #9FB93D">
		          <table width=100%>
<?php

// go thru database and print the flowers out
$result = db_query("select * from flowers");
$row = fetch_row($result);
while ($row){
	echo "<tr><td align=left>\n";
	echo "<p class=\"Content\">".$row["name"]."</p>\n";
	echo "</td><td>\n";
	echo "<p class=\"Content\"><img border=\"0\" onclick=\"NewWindow('showdetails.php?type=flowers&id=".$row["uid"]."','Page','400','400','yes');\" ";
	echo "src=\"uploads/flowers/".$row["uid"]."/pic.gif\">\n";
	// does the user have a cart
	if (!isset( $_COOKIE["flowershop_cart"])) {
		// no, just print out the checkbox
		echo "<input type=\"checkbox\" name=\"".$row["uid"]."\">\n";
	}
	else{
		//yes, see if the user has selected the flower and check it if so
		$cartid = $_COOKIE["flowershop_cart"];
		$flowers=db_query("select * from flowercart where cartid=$cartid and flowerid=".$row["uid"]);
		if (num_rows($flowers) == 1){
			echo "<input type=\"checkbox\" checked name=\"".$row["uid"]."\">\n";
		}
		else{
			echo "<input type=\"checkbox\" name=\"".$row["uid"]."\">\n";
		}
	}
	echo " [$".$row["price"]." each]</p>\n";
	echo "</td></tr>\n";

	$row = fetch_row($result);
}


?>
                  </table>
		          </div>
	             </td>
              </tr>
              <tr>
                <td align="right">
                  <br>
                  <p class="Content">How many arrangements would you like

<?php
// see if user has cart and update the quantity if so
if (!isset( $_COOKIE["flowershop_cart"] )) {
		// no, just print input field
		echo "<input name=\"quantity\" size=\"3\" value=\"1\" onblur=\"checkqty();\">\n";
	}
else{
	// get the cart value and put it in the input field
	$result = db_query("select * from cart where uid=".$_COOKIE["flowershop_cart"]);
	$row = fetch_row($result);
	echo "<input name=\"quantity\" size=\"3\" value=\"".$row["flowerquantity"]."\"  onblur=\"checkqty();\">\n";
}

close_db();
?>

                  <input type="image" alt="Add to cart" src="images/addcart.gif"></p>
	            </td>
              </tr>
            </table>
			</form>
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
