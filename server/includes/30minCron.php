#!/usr/local/bin/php -q
<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

require_once("/var/www/ITisGood/websites/hostingspeed/includes/include.php");
init();

//if($_GET['apikey'] != 'a8JhIug86HGlufgj')
//	die();


   $insertStmt= $dbh->prepare("INSERT INTO results (hostid, time, test1, test2, test3 )
  VALUES( :hostid, :time, :test1, :test2, :test3)");
      

//$dt = sqlesc(get_date_time(strtotime("-4 MONTHS")));
$s = $dbh->prepare("SELECT * FROM testhosts WHERE active = 'yes'");
$s->execute();

foreach($s->fetchAll() as $r)
{

   $url = 'http://elmered.com/test/index.php?menuID=11';

   $url = $r['url'].'?iterations=1000&tabletype=MYISAM';

   $post_data = '';
   
   $error = false;
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL,$url);
   curl_setopt($ch, CURLOPT_POST, 1 );
   curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

   $postResult = curl_exec($ch);

   if(curl_errno($ch))
   {
      print curl_error($ch).': '.curl_errno($ch);
      curl_close($ch);

      //write to logfile

      $error = true;
      echo  'Error';
   }
   else
   {
      curl_close($ch);

      //echo $postResult;
      
      $arr = explode('|', $postResult);
      print_r($arr);

   $repalce_arr = array(
      ':hostid' => $r['id'], 
      ':time' => time(), 
      ':test1' => $arr[1], 
      ':test2' => $arr[2], 
      ':test3' => $arr[3]
   );

   $insertStmt->execute($repalce_arr );

      
   }

   /*
	sql_unbuff("INSERT INTO logg_cleanup ('date', 'action', 'ad_id', 'info1', 'info2') VALUES('inactivated', ".sqlesc($ad['id']).", ".sqlesc($ad['mail']).", ".sqlesc($ad['title']).")");
	
	if(mysql_affected_rows() == 1)
		sql_unbuff("UPDATE ads SET active = 'no', old = 'yes' WHERE id = ".sqlesc($ad['id']));
	
	if(mysql_affected_rows() != 1)
		echo "error";
   */
}



/*
$dt = sqlesc(get_date_time(strtotime("-4 MONTHS")));
$res = sql("SELECT * FROM ads WHERE added < ".sqlesc($dt)." AND active = 'yes'");

while($ad = mysql_fetch_assoc($res))
{
	sql_unbuff("INSERT INTO logg_cleanup ('date', 'action', 'ad_id', 'info1', 'info2') VALUES('inactivated', ".sqlesc($ad['id']).", ".sqlesc($ad['mail']).", ".sqlesc($ad['title']).")");
	
	if(mysql_affected_rows() == 1)
		sql_unbuff("UPDATE ads SET active = 'no', old = 'yes' WHERE id = ".sqlesc($ad['id']));
	
	if(mysql_affected_rows() != 1)
		echo "error";
}

$dt = sqlesc(get_date_time(strtotime("-5 MONTHS")));
$res = sql("SELECT * FROM ads WHERE added < ".$dt." AND old = 'yes'");

while($ad = mysql_fetch_assoc($res))
{
	sql_unbuff("INSERT INTO logg_cleanup ('date', 'action', 'ad_id', 'info1', 'info2') VALUES('deleted', ".sqlesc($ad['id']).", ".sqlesc($ad['mail'])."', ".sqlesc($ad['title']).")");
	
	if(mysql_affected_rows() == 1)
		sql_unbuff("DELETE FROM ads WHERE ".sqlesc($ad['id'])." old = 'yes'");
	
	if(mysql_affected_rows() != 1)
		echo "error";
}
*/
?>
