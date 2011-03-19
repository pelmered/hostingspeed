<?php
/*
$dbCredentials = array(
   'localhost',  // The host to connect to 
   'root',       // The user to connect as 
   '', //); //,   // The password to use 
   ''     // The default database to query 
);
*/
//Kommentera bort ovan och fyll i och ta bort require nedan
require '../../includes/secrets.php';

$dbl = mysqli_connect($dbCredentials[0], $dbCredentials[1], $dbCredentials[2], $dbCredentials[3]);

$dbh = new PDO('mysql:host='.$dbCredentials[0].';dbname='.$dbCredentials[3], $dbCredentials[1], $dbCredentials[2] );

if (!$dbl) {
   printf("Can't connect to MySQL Server. Errorcode: %s\n", mysqli_connect_error());
   exit;
} 

?>