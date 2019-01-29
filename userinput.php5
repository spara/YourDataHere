<?php

echo("<html><body>");

// open connection to mysql
//get this information from the 1&1 admin site
$dbhost = 'test';
$dbuser = 'test';
$dbpass = 'test';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
$dbname = 'newyorkcitystuff';
mysql_select_db($dbname);


//grab inputs.  
//define the number fields as floats.
//treat the text strings with html escapes and international symbols.
 
$who = htmlspecialchars(strip_tags(utf8_encode($_GET['names'])));
$workshop = htmlspecialchars(strip_tags(utf8_encode($_GET['group'])));
$when = htmlspecialchars(strip_tags(utf8_encode($_GET['dateOf'])));
$onStreet = htmlspecialchars(strip_tags(utf8_encode($_GET['onStreet'])));
$startXStreet = htmlspecialchars(strip_tags(utf8_encode($_GET['startXStreet'])));
$endXStreet = htmlspecialchars(strip_tags(utf8_encode($_GET['endXStreet'])));
$starty = (float)$_GET['starty'];
$startx = (float)$_GET['startx'];
$endy = (float)$_GET['endy'];
$endx = (float)$_GET['endx'];
$side = htmlspecialchars(strip_tags(utf8_encode($_GET['side'])));
$hasTrees =  (float)$_GET['hasTrees'];
$enddist = (float)$_GET['enddist'];

// do SQL insert
//the 2nd line here names the fields
//the 3rd line pulls in what was typed into the form as values for each of those fields. 
//the single quotes are for MySQL, the double quotes are for PHP
//make timestamp
$query = "INSERT INTO `userinput` " . 
			"VALUES ('','" . $who . "','" . $workshop . "','" . $when . "','" . $onStreet . "','" . $startXStreet . "','" . $endXStreet . "','" . $starty . "','" . $startx . "','" . $endy . "','" . $endx . "','" . $side . "','" . $hasTrees . "'";
				
for ( $treecounter = 1; $treecounter <= 24; $treecounter += 1) {
  $query = $query . ",'" . (float)$_GET['dist' . $treecounter] . "'";
	$query = $query . ",'" . (float)$_GET['length' . $treecounter] . "'";
	$query = $query . ",'" . (float)$_GET['width' . $treecounter] . "'";
	$query = $query . ",'" . (float)$_GET['circ' . $treecounter] . "'";
  $query = $query . ",'" . htmlspecialchars(strip_tags(utf8_encode($_GET['housenum' . $treecounter]))) . "'";
	$query = $query . ",'" . htmlspecialchars(strip_tags(utf8_encode($_GET['streetname' . $treecounter]))) . "'";
	$query = $query . ",'" . htmlspecialchars(strip_tags(utf8_encode($_GET['position' . $treecounter]))) . "'";
	$query = $query . ",'" . htmlspecialchars(strip_tags(utf8_encode($_GET['status' . $treecounter]))) . "'";
	$query = $query . ",'" . htmlspecialchars(strip_tags(utf8_encode($_GET['species' . $treecounter]))) . "'";
	$query = $query . ",'" . (float)$_GET['speciesconfirmed' . $treecounter] . "'";
	$query = $query . ",'" . (float)$_GET['damage' . $treecounter] . "'";
	
}
$query = $query . ",'" . $enddist . "');";
				
				//echo($query);
				
				echo "Successful form completion.  Woohoo!  ";
				mysql_query($query) or die('Error, insert query failed');

// close mysql connection
mysql_close($conn);
echo("</body></html>");



?>

