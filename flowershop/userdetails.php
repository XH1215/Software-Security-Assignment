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
session_start();    
$result=db_query("select * from users where uid=".$_GET["id"]);
$row=fetch_row($result);
$csrfToken = $_SESSION['csrf_token'];
while($row){
	echo "<p class=\"content\">Here are your user details.\n";
	echo "<br><br>\n";
	echo "<form action=\"updatedetails.php\" method=\"post\">\n";
	echo "<input type=\"hidden\" name=\"userid\" value=\"".$row["uid"]."\">\n";
    echo "<input type=\"hidden\" name=\"csrf_token\" value=\"" . $csrfToken . "\">\n";


?>
	<table>
              <tr>
                <td class="Content">Name</font></td>
                <td><input name="name" size="65" maxlength="100" value="<?php echo $row["name"] ?>"></td>
              </tr>
              <tr>
                <td valign="top" class="Content">Address</td>
                <td><textarea name="address" cols="60" rows="4" wrap="PHYSICAL"><?php echo $row["address"] ?></textarea></td>
              </tr>
              <tr>
                <td><img height="5" src="images/px.gif"></td>
                <td></td>
              </tr>
              <tr>
                <td class="Content">Card Type</td>
                <td valign="middle"><input name="cardtype" type="radio" value="visa" checked>
                    <img src="images/visa.gif" width="53" height="33"> &nbsp;
                    &nbsp;
                    <input type="radio" name="cardtype" value="mc">
                    <img src="images/mc.gif" width="44" height="28"> &nbsp; &nbsp;
                    <input type="radio" name="cardtype" value="amex">
                    <img src="images/amex.gif" width="42" height="41"> </td>
              </tr>
              <tr>
                <td class="Content">Card Number</td>
                <td><input name="cardnumber" maxlength="16" value="<?php echo $row["cardnumber"] ?>"></td>
              </tr>



              <tr>
                <td class="Content">Expiry Date</td>
                <td><select name="expmonth">
                      <option value="1" <?php if($row["expirymonth"]==1) echo "selected" ?> >1</option>
                      <option value="2" <?php if($row["expirymonth"]==2) echo "selected" ?> >2</option>
                      <option value="3" <?php if($row["expirymonth"]==3) echo "selected" ?> >3</option>
                      <option value="4" <?php if($row["expirymonth"]==4) echo "selected" ?> >4</option>
                      <option value="5" <?php if($row["expirymonth"]==5) echo "selected" ?> >5</option>
                      <option value="6" <?php if($row["expirymonth"]==6) echo "selected" ?> >6</option>
                      <option value="7" <?php if($row["expirymonth"]==7) echo "selected" ?> >7</option>
                      <option value="8" <?php if($row["expirymonth"]==8) echo "selected" ?> >8</option>
                      <option value="9" <?php if($row["expirymonth"]==9) echo "selected" ?> >9</option>
                      <option value="10" <?php if($row["expirymonth"]==10) echo "selected" ?> >10</option>
                      <option value="11" <?php if($row["expirymonth"]==11) echo "selected" ?> >11</option>
                      <option value="12" <?php if($row["expirymonth"]==12) echo "selected" ?> >12</option>
                    </select>

                    <span class="Content">/
                    <select name="expyear">
                      <option value="2004" <?php if($row["expiryyear"]==2004) echo "selected" ?> >2004</option>
                      <option value="2005" <?php if($row["expiryyear"]==2005) echo "selected" ?> >2005</option>
                      <option value="2006" <?php if($row["expiryyear"]==2006) echo "selected" ?> >2006</option>
                      <option value="2007" <?php if($row["expiryyear"]==2007) echo "selected" ?> >2007</option>
                      <option value="2008" <?php if($row["expiryyear"]==2008) echo "selected" ?> >2008</option>
                      <option value="2009" <?php if($row["expiryyear"]==2009) echo "selected" ?> >2009</option>
                      <option value="2010" <?php if($row["expiryyear"]==2010) echo "selected" ?> >2010</option>
                      <option value="2011" <?php if($row["expiryyear"]==2011) echo "selected" ?> >2011</option>
                      <option value="2012" <?php if($row["expiryyear"]==2012) echo "selected" ?> >2012</option>
                      <option value="2013" <?php if($row["expiryyear"]==2013) echo "selected" ?> >2013</option>
                      <option value="2014" <?php if($row["expiryyear"]==2014) echo "selected" ?> >2014</option>
                      <option value="2015" <?php if($row["expiryyear"]==2015) echo "selected" ?> >2015</option>
                    </select>
                    </span></td>
              </tr>
              <tr>
                <td><img height="5" src="images/px.gif"></td>
                <td></td>
              </tr>
              <tr>
                <td class="Content">Login</td>
                <td><input name="login" type="text" value="<?php echo $row["login"] ?>"></td>
              </tr>
              <tr>
                <td class="Content">Password</td>
                <td><input name="password" type="password" value="<?php echo $row["password"] ?>"></td>
              </tr>
                <td>&nbsp;</td>
                <td><input type="submit" value="Update"></td>

              </tr>
            </table>
            </form>
            <br><br>
<?php

	$row=fetch_row($result);
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
