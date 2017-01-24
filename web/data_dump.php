<?php

require("dbconnect_info.php");
// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
// Opens a connection to a MySQL server


$connection=mysqli_connect ('127.0.0.1', $username, $password,$database);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Select all the rows in the markers table

// Perform a query, check for error
$result = mysqli_query($connection,"SELECT * FROM markers WHERE 1");
  if(!$result)
  {
  echo("Error description: " . mysqli_error($connection));
  }

#header("Content-type: text/xml");
#header("Content-Type: text/html; charset=utf-8");
// Iterate through the rows, adding XML nodes for each

while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("type", $row['type']);
}

$myfile = fopen("newfile.xml", "w") or die("Unable to open file!");
fwrite($myfile, $dom->saveXML());
fclose($myfile);

echo $dom->saveXML();

?>