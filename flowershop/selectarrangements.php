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
            <p class="Content">Select the arrangements you would like to purchase and their quantity.
            If you would like further details about any arrangemnet, click its image.</p>
			<form name="arrangementsfrm" action="buyarrangements.php" method="post">
			<table width="400" align="center">
              <tr>
                <td>
                  <div style="overflow: auto; width: 400px; height: 200px; scrollbar-base-color: #9FB93D">
		          <table width=100%>
<?php

// go thru database and print the flowers out
$result = db_query("select * from arrangements");
$row = fetch_row($result);
while ($row){
	echo "<tr><td align=left>\n";
	echo "<p class=\"Content\">".$row["name"]."</p>\n";
	echo "</td><td>\n";
	echo "<p class=\"Content\"><img border=\"0\" onclick=\"NewWindow('showdetails.php?type=arrangements&id=".$row["uid"]."','Page','400','400','yes');\" ";
	echo "src=\"uploads/arrangements/".$row["uid"]."/pic.gif\">\n";
	$price = $row["price"];
	echo "<select name=\"".$row["uid"]."\">\n";
	echo "<option value=\"0\">0</option>\n";
	// does the user have a cart
	if (!isset( $_COOKIE["flowershop_cart"])) {
		// no, just print out the quantity options
		for ($i = 1; $i <= 10; $i++) {
			echo "<option value=\"$i\">$i</option>\n";
		}
	}
	else{
		//yes, see if the user has selected the arrangement, how pre-select the quantity
		$cartid = $_COOKIE["flowershop_cart"];
		$qty="";
		$flowers=db_query("select * from arrangementcart where cartid=$cartid and arrangementid=".$row["uid"]);
		if (num_rows($flowers) == 1){
			$qrow=fetch_row($flowers);
			$qty = $qrow["quantity"];
		}
		for ($i = 1; $i <= 10; $i++) {
			if ($i == $qty){
				echo "<option selected value=\"$i\">$i</option>\n";
			}
			else{
				echo "<option value=\"$i\">$i</option>\n";
			}
		}

	}
	echo "</select>\n";
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
