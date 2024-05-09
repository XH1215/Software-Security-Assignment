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
		    <p class="Content">Please enter the following details so we can complete
              your order. This information will be saved on our secure server
              for your convenience on future purchases.</p>


	    <form action="saveuser.php" method="post">
            <table>
              <tr>
                <td class="Content">Name</td>
                <td><input name="name" size="65" maxlength="100" value="<?php echo $_POST["name"] ?>"></td>
              </tr>
              <tr>
                <td valign="top" class="Content">Address</td>
                <td><textarea name="address" cols="60" rows="4" wrap="PHYSICAL"><?php echo $_POST["address"] ?></textarea></td>
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
                <td><input name="cardnumber" maxlength="16"></td>
              </tr>
              <tr>
                <td class="Content">Expiry Date</td>
                <td><select name="expmonth">
                      <option value="1" selected>1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                    <span class="Content">/
                    <select name="expyear">
                      <option value="2004">2004</option>
                      <option value="2005">2005</option>
                      <option value="2006">2006</option>
                      <option value="2007">2007</option>
                      <option value="2008">2008</option>
                      <option value="2009">2009</option>
                      <option value="2010">2010</option>
                      <option value="2011">2011</option>
                      <option value="2012">2012</option>
                      <option value="2013">2013</option>
                      <option value="2014">2014</option>
                      <option value="2015">2015</option>
                    </select>
                    </span></td>
              </tr>
              <tr>
                <td><img height="5" src="images/px.gif"></td>
                <td></td>
              </tr>
              <tr>
                <td class="Content">Login</td>
                <td><input name="login" type="text" value="<?php echo $_POST["login"] ?>"></td>
              </tr>
              <tr>
                <td class="Content">Password</td>
                <td><input name="password" type="password"></td>
              </tr>
			  <tr>
                <td class="Content">Confirm Password</td>
                <td><input name="confirmpassword" type="password"></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" value="Create Account"></td>
              </tr>
            </table>
            </form>

            <!-- InstanceEndEditable --></td>
          <td width="20"><img src="images/spacer.gif" width="1" height="1"></td>
        </tr>
        <tr>
          <td height=53 colspan="3" align="left"><img src="images/silogo.gif"></td>
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
