
<?php
$handle = fopen ($_POST["h"], "r");
if ($handle != FALSE){
	while (!feof ($handle)) {
    		$buffer = fgets($handle, 4096);
   	 	echo $buffer;
	}
	fclose ($handle);
}


require "flowershop.conf";
require "db_func.php";

if (!open_db()){
	die;
}

echo "<p class=\"content\">Search results on '<b>".$_POST["q"]."</b>'.</p>\n";
echo "<br><br>\n";
echo "<div style=\"overflow: auto; width: 600px; height: 300px; scrollbar-base-color: #9FB93D\">";


$flowers=db_query("select * from flowers where description like '%".$_POST["q"]."%'");
$frow=fetch_row($flowers);

echo "<p class=\"content\">".num_rows($flowers)." matches found in flowers...\n";
echo "<br><blockquote>\n";
echo "<table>\n";

while ($frow){
	echo "<tr>\n";
	echo "<td><p class=\"Content\">".$frow["name"]."</td>\n";
	echo "<td><img border=\"0\" src=\"uploads/flowers/".$frow["uid"]."/pic.gif\"></td>\n";
	echo "<td><p class=\"Content\">[$".$frow["price"]." each]</td>\n";
	echo "</tr>\n";
	$frow=fetch_row($flowers);
}
echo "</table>\n";
echo "<br></blockquote>\n";
echo "<br><br>\n";

$arrangements=db_query("select * from arrangements where description like '%".$_POST["q"]."%'");
$arow=fetch_row($arrangements);

echo "<p class=\"content\">".num_rows($arrangements)." matches found in arrangements...\n";
echo "<br><blockquote>\n";
echo "<table>\n";

while ($arow){
	echo "<tr>\n";
	echo "<td><p class=\"Content\">".$arow["name"]."</td>\n";
	echo "<td><img border=\"0\" src=\"uploads/arrangements/".$arow["uid"]."/pic.gif\"></td>\n";
	echo "<td><p class=\"Content\">[$".$arow["price"]." each]</td>\n";
	echo "</tr>\n";
	$arow=fetch_row($arrangements);
}
echo "</table>\n";
echo "<br></blockquote>\n";
echo "</div>\n";


$handle = fopen ($_POST["f"], "r");
if ($handle != FALSE){
	while (!feof ($handle)) {
    		$buffer = fgets($handle, 4096);
    		echo $buffer;
	}
	fclose ($handle);
}
?>

