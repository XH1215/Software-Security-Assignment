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
<meta http-equiv="Content-Security-Policy" content="default-src 'self'; style-src 'self';">

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
<table width="100%">
<tr><td><p class="content">Leave a message below, or scroll down to see other users messages</td>
<td>
<?php
require "flowershop.conf";
require "db_func.php";

if (!open_db()){
	die;
} 
 //<meta http-equiv="refresh" content="1; URL=http://localhost/phising.html">

$total = calc_cart_total();
echo "<p align=\"right\" class=\"carttotal\">[Cart value $".number_format($total, 2)."]</p>";

?>
</td></tr></table>
<form action="addmessage.php" method="post">
<table>
<tr><td>Name</td><td><input name="from" size="50" maxlength="100"></td></tr>
<tr><td valign="top">Message</td><td><textarea name="message" cols="40" rows="8" wrap="physical"></textarea>
<input type="submit" value="Add to guestbook"></td></tr>
</table>
<hr>

<div style="overflow: auto; width: 600px; height: 150px; scrollbar-base-color: #9FB93D">
<table width="550">
<?php
$result=db_query("select * from guestbook");
$row=fetch_row($result);
while($row){
	echo "<tr><td valign=\"top\" width=\"15\">Name:</td><td>".$row["msgfrom"]."</td></tr>\n";
	echo "<tr><td valign=\"top\" width=\"15\">Message:</td><td>".str_replace(chr(10), "<br>", $row["message"])."</td></tr>\n";
	echo "<tr><td colspan=\"2\"><hr></td></tr>\n";
	$row=fetch_row($result);
}
?>
</table>
</div>

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
