<?php

		
/* Connect to a MySQL database using driver invocation */
$servername='localhost';
$username = '';
$password = '';


//$servername = "localhost";
//$username = "root";
//$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=dariuszpta_baza", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "Connected successfully";
} catch(PDOException $e) {
  //echo "Connection failed: " . $e->getMessage();
}

?>