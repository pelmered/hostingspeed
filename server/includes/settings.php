<?php
/**
* Description of settings
*
* @author Peter
*/
require_once("/var/www/ITisGood/globalIncludes/secrets.php");


define('SITEPREFIX', 'hostingspeed_');

define('_DB_', 'hostingspeed');
$dbname = "hostingspeed";

define('DEFAULTBASEURL', '');

$dbh = new PDO('mysql:host='.$mysql_host.';dbname='.$dbname, $mysql_user, $mysql_pass );

//die("Strax tillbaka, databasen uppgraderas");


//$BASEURL = 'http://no.sahklo.com/';

/*
if ($_SERVER["HTTP_HOST"] == "")
	$_SERVER["HTTP_HOST"] = $_SERVER["SERVER_NAME"];

// Standard-adress (utan avslutande /), url till bilder, baseurl
if ($_SERVER["HTTPS"])
{
	$BASEURL = "https://".$_SERVER["HTTP_HOST"];
	if($_SESSION['location'] != "")
		$LINKURL = "http://".$_SERVER["HTTP_HOST"].'/'.$_SESSION['location'];
	else
		$LINKURL = "http://".$_SERVER["HTTP_HOST"];
	$DEFAULTBASEURL = "https://dev.itisgood.se";
	$adpic_base_url = $BASEURL."/bilder/ads/";
	$pic_base_url = $BASEURL."/img/";
	$css_base_url = $BASEURL."/css/";}
else
{
	$BASEURL = "http://".$_SERVER["HTTP_HOST"];
	if($_SESSION['location'] != "")
		$LINKURL = "http://".$_SERVER["HTTP_HOST"].'/'.$_SESSION['location'];
	else
		$LINKURL = "http://".$_SERVER["HTTP_HOST"];
	$DEFAULTBASEURL = "http://dev.itisgood.se";
	$adpic_base_url = $_SERVER['DOCUMENT_ROOT']."/bilder/ads/";
	$pic_base_url = $BASEURL."/img/";
	$css_base_url = $BASEURL."/css/";
}
*/
$db = 'itisgood_se';

$mail = "info@elmered.com";
//$logPath = "/var/log/koposalj";
//$logPath = "../logs";


$adMaxlength = 2500;
$adsPerPage = 30;

$bdir = "bilder/ads/big/";   // Path To Orginal Images Directory
$ndir = "bilder/ads/normal/";   // Path To Images Directory
$tdir = "bilder/ads/thumbs/";   // Path To Thumbnails Directory

$IMGDIR = 'img/';


//Statisk lösenordssalt - ÄNDRA INTE!
$pwsalt = '0hn-ybH81>k!2Pm4z#g36ck';






?>
