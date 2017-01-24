<?php require("dbconnect_info.php");
$conn=mysqli_connect ('127.0.0.1', $username, $password,$database);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$lat=$_GET['lat'];
$lon=$_GET['lon'];
// attempt insert query execution
$sql = "INSERT INTO markers(lat,lng) VALUES ('$lat','$lon')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close(); ?>