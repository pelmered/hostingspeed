#!/usr/local/bin/php -q
<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

/*
@TODO
 * Felhantering,
   * Upptäcka fel på klienten. 
   * Logga fel på servern 
   * Lnaktivera eller minska frekvens på klienter efter visst antal misslyckade försök
 * Lägg till fler test
 *  

*/
require_once("/var/www/hostingspeed/includes/include.php");

$insertTestStmt = $dbh->prepare("INSERT INTO tests (hostid, time) 
   VALUES( :hostid, :time)");

$insertResultStmt = $dbh->prepare("INSERT INTO testresults (testid, time, testtype, result ) 
   VALUES( :testid, :time, :testtype, :result)");


//$dt = sqlesc(get_date_time(strtotime("-4 MONTHS")));
$s = $dbh->prepare("SELECT * FROM testhosts WHERE active = 'yes'");
$s->execute();

foreach ($s->fetchAll() as $r) {

   //$url = 'http://elmered.com/test/index.php';

   $url = $r['url'] . '?iterations=1000&tabletype=MYISAM';

   $post_data = '';

   $error = false;
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

   $postResult = curl_exec($ch);

   if (curl_errno($ch)) {
      print curl_error($ch) . ': ' . curl_errno($ch);
      curl_close($ch);

      //write to logfile

      $error = true;
      echo 'Error';
   } else {
      curl_close($ch);

      //echo $postResult;

      $arr = explode('|', $postResult);
      //print_r($arr);
      if(is_array($arr))
      {
         
         $hostId = $r['id'];

         $repalce_arr = array(
          ':hostid' => $hostId,
          ':time' => time()
         );

         $insertTestStmt->execute($repalce_arr);

         $testId = $dbh->lastInsertId();

         foreach ($arr as $result) {
            $t = explode(':', $result);

            $r[$t[0]] = $t[1];
            if(isset ($t[0]) && isset ($t[1]) )
            {
               $repalce_arr = array(
                ':testid' => $testId,
                ':time' => time(),
                ':testtype' => $t[0],
                ':result' => $t[1]
               );

               $insertResultStmt->execute($repalce_arr);
            }
         }
      }
      print_r($r);
   }
}

?>