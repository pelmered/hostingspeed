<?php
$starttime = '';
$totaltime = '';


function getTime($starttime)
{
   $endtime = microtime();

   $startarray = explode(" ", $starttime);
   $starttime = $startarray[1] + $startarray[0];

   $endarray = explode(" ", $endtime);
   $endtime = $endarray[1] + $endarray[0];
   $totaltime = $endtime - $starttime;
   $totaltime = round($totaltime, 5);
   
   return $totaltime;
}



function func_insert()
{
   global $dbl, $dbName, $tableName, $numIter, $randStrArr;
   
   //Timer Start
   $st = microtime();    
   
   //Perform test - INSERT
   for ($i = 0; $i < $numIter; $i++)
   {
      mysqli_query($dbl, "INSERT INTO `$dbName`.`$tableName` (`id` ,`testcolumn`)VALUES ($i , '".$randStrArr[$i]['s']."' )");
      // echo "$i Insert<br>";
   }
    //Timer end
   return getTime($st);
}

function func_insert_pdo()
{
   global $dbh, $dbName, $tableName, $numIter, $randStrArr;
   
   //Prepare test(Operations that should not be timed)
   $insertStmt= $dbh->prepare("INSERT INTO results ( `id` ,`testcolumn` ) VALUES( :id, :teststr)");
   
   //Timer Start
   $st = microtime();
   
   //Perform test - INSERT PDO
   for ($i = 0; $i < $numIter; $i++) {
      $insertStmt->bindParam(':id', $i, PDO::PARAM_INT);
      $insertStmt->bindParam(':teststr', $randStrArr[$i]['s'], PDO::PARAM_STR, $randStrArr[$i]['l']);

      $insertStmt->execute( );
   }
    
    //Get time and return exec time
   return getTime($st);
}


/**
 *
 * @global type $dbl
 * @global type $dbName
 * @global type $tableName
 * @global type $numIter
 * @global type $randStrArr
 * @return type 
 */
function func_update()
{
   global $dbl, $dbName, $tableName, $numIter, $randStrArr;
   
   //Timer Start
   $st = microtime();    
   
   //Perform test - Update Rows
   for ($i = 0; $i < $numIter; $i++) {
      $updateQuery = "UPDATE `$dbName`.`$tableName` SET testcolumn = '".$randStrArr[$i]['s']."' WHERE ID > 0";
      mysqli_query($dbl, $updateQuery);
   }
//Timer end
   return getTime($st);
}

function func_select()
{
   global $dbl, $dbName, $tableName, $numIter, $randStrArr;
   
   //Timer Start
   $st = microtime();    
   
   //Perform test - Select
   $selectQuery = "SELECT * from `$dbName`.`$tableName`"; // where...
   if ($resultSelect = mysqli_query($dbl, $selectQuery)) {
      while ($rowSelect = mysqli_fetch_assoc($resultSelect)) {
         //echo $rowGeographyCountyCoords['latitude'] , "LAT-- ROOT --LONG", $rowGeographyCountyCoords['longitude'] , "<hr>";
         $currentID = $rowSelect['id'];
         $currentTestColumn = $rowSelect['testcolumn'];
         //$selectCounter ++;
         //echo "$currentID <br>";
      }

      /* Close the result set and free the memory used for it  */
      mysqli_free_result($resultSelect);
   }

    //Timer end
   return getTime($st);
}


?>
