<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<p>Add Arrangement
<form action="savearrangement.php" method="post" enctype="multipart/form-data">
  <table width="80%" border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td width="17%">Arrangement Name</td>
      <td width="83%"><input name="arrangementname" type="text" id="arrangementname"></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><input name="price" type="text" id="price" value="0.00"></td>
    </tr>
    <tr> 
      <td valign="top">Description </td>
      <td><textarea name="description" cols="60" rows="5" wrap="PHYSICAL"></textarea></td>
    </tr>
    <tr> 
      <td>Picture</td>
      <td><input name="picfile" type="file" id="picfile"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
</body>
</html>
