<?php
ini_set('display_errors', 1);
ini_set('log_errors', 0);

require("dbconnect.inc.php");

require("functions.php");

$dbName = "speedtestdb";
$tableName = "speedtesttable";


//  Number of records to test with
$numIter = $_GET['iterations'];
if ($numIter == 0) {
   $numIter = 500;
}

//Table type to test with  --- add dropdown for other table types
$tableType = $_GET['tabletype'];
if ($tableType == NULL) {
   $tableType = "MYISAM";
}

// Create the database here  *************************************************************************************************************************************************************************
// Drops existing table if the script is re-run
$delete_query = "DROP TABLE `$dbName`.`$tableName` ";
mysqli_query($dbl, $delete_query);

$createDBQuery = "CREATE DATABASE `$dbName` ;";
mysqli_query($dbl, $createDBQuery);
//	echo "Successfully created database <b>$dbName</b><br />";
// Create the test table
$createTableQuery = "CREATE TABLE `$dbName`.`$tableName` (`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,`testcolumn` VARCHAR( 255 ) NOT NULL) ENGINE = $tableType ";
mysqli_query($dbl, $createTableQuery);
//	echo "Sucessfully created table <b>$tableName</b><br /><br />";	
// CHECK for InnoDB support  *************************************************************************************************************************************************************************
$checkInnoDBQuery = "SHOW TABLE STATUS FROM $dbName WHERE Name = '$tableName' "; // SHOW TABLE STATUS FROM speedtestdb WHERE Name = 'speedtesttable'
mysqli_query($dbl, $checkInnoDBQuery);

if ($resultTableCheck = mysqli_query($dbl, $checkInnoDBQuery)) {
   while ($rowInnoDB = mysqli_fetch_assoc($resultTableCheck)) {
      //echo $rowGeographyCountyCoords['latitude'] , "LAT-- ROOT --LONG", $rowGeographyCountyCoords['longitude'] , "<hr>";
      $tableTypeVerified = $rowInnoDB['Engine'];
      //echo "$currentID <br>";
   }
   
   /* Close the result set and free the memory used for it  */
   mysqli_free_result($resultTableCheck);
}

// VERIFY the support for selected table type	
$tableType = strtoupper($tableType);
$tableTypeVerified = strtoupper($tableTypeVerified);

if ($tableType != $tableTypeVerified) {
   die("<font color=\"red\"><strong>This MySQL instance does NOT support $tableType tables</strong></font><br />");
}

$randStrArr = array();    

for ($i = 0; $i < $numIter; $i++) {

   $length = mt_rand(5, 15);
   $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
   $string='';
   
   for ($p = 0; $p < $length; $p++) {
      $string .= $characters[mt_rand(0, strlen($characters)-1)];
   }
   
   $randStrArr[$i]['s'] = $string;
   $randStrArr[$i]['l'] = $length;
}
   
print_r($randStrArr);

 //TODO: Hämta från DB
$tests = array(
    'insert',
    'insert_pdo',
    'select',
    'update'
);

foreach ($tests as $t) {

   $totaltime = '';
   echo $t.':';
   
   $totaltime = call_user_func('func_'.$t);
   
  
   $IPS = round($numIter / $totaltime);
   echo $IPS . "|";
}