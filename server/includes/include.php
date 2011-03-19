<?php
session_start();

	//Visa PHP fel
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 1);

	//Inkludera filer som behövs
	//Fil med funktioner för sidan.
require_once("functions.php");

	//Inkudera fil för statiska värden och inställningar
require_once("settings.php");

//init();
//$mc = new Cache(SITEPREFIX);

$lang = array_shift(explode('.', $_SERVER['HTTP_HOST']));

switch($lang)
{
   case 'no':
      $lang = 'no';
      $month_arr = array(
       '01' => 'Januar',
       '02' => 'Februar',
       '03' => 'Mars',
       '04' => 'April',
       '05' => 'Mai',
       '06' => 'Juni',
       '07' => 'Juli',
       '08' => 'August',
       '09' => 'September',
       '10' => 'Oktober',
       '11' => 'November',
       '12' => 'Desember'
      );
      break;
   case 'en':
      $lang = 'en';
      
      $month_arr = array(
       '01' => 'January',
       '02' => 'February',
       '03' => 'Mars',
       '04' => 'April',
       '05' => 'May',
       '06' => 'June',
       '07' => 'July',
       '08' => 'August',
       '09' => 'September',
       '10' => 'October',
       '11' => 'November',
       '12' => 'December'
      );

      break;
   default:
      $lang = 'sv';
      $month_arr = array(
       '01' => 'Januari',
       '02' => 'Februari',
       '03' => 'Mars',
       '04' => 'April',
       '05' => 'Maj',
       '06' => 'Juni',
       '07' => 'Juli',
       '08' => 'Augusti',
       '09' => 'September',
       '10' => 'Oktober',
       '11' => 'November',
       '12' => 'December'
      );
}


$url=strip_tags(trim($_SERVER['REQUEST_URI'], '/'));
$url_array=explode("/",$url);
$url = array_shift(explode("?", $url));
$urls = (explode("/", $url));

function getHeader($page = '')
{
   global $BASEURL, $lang, $url_array;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="" />

   <title><?
      echo 'Hostingspeed.se';
   
   if(isset ($page) && $page != '')
      echo ' - '.$page;
   else if(isset ($url_arr[1]) && $url_arr[1] != '')
      echo ' - ' . ucfirst($url_arr[1]);
	?></title>

	<link rel="shortcut icon" href="<?=$DEFAULTBASEURL?>/img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="<?=$BASEURL?>/style/style.css" />

   <script type="text/javascript" src="<?=$BASEURL?>/js/js.js" ></script>
   
   <script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAFdm6WGBkrbY64dK8SKvzjRQ46mJjJ8_a-8e5aSu3UwLuJZLTihStwCuPOenqlAfM_P9FGHo_gLAC-A"></script>
   <script type="text/javascript">
      //google.load("jquery", "1.3.2");
      google.load("jquery", "1.4");
      google.load("jqueryui", "1.8.1");
      </script>
   
   <script type="text/javascript" src="http://script.itisgood.se/openwysiwyg/wysiwyg.js"></script>
   <script type="text/javascript" src="http://script.itisgood.se/openwysiwyg/wysiwyg-settings.js"></script>
</head>
<body>
   <div id="contet">
<?php
}

function getFooter()
{
?>
	</div>
	<div id='footer'>
		Design by <a href="http://elmered.com/">Peter Elmered</a> 2010
      <div class="login">
         <a href="/login">Logga in</a>
      </div>
	</div>
</div>
</body>
</html>
<?php
}

function stdmsg($heading, $text)
{
	if (headers_sent()) {

		echo "<div class='msgbox'>";
		if ($heading)
			echo "<span class='h3'>".$heading."</span>\n";
		echo "<div class='msgtext'>".$text."</div>";
		echo "</div>";
	}
	else {
		getHeader();
		echo "<div class='msgbox'>";
		if ($heading)
			echo "<span class='h3'>".$heading."</span><br/><br/>\n";
		echo "<div class='msgtext'>".$text."</div>";
		echo "</div>";
		getFooter();
	}
}

function error($heading, $text)
{
	die(stdmsg($heading, $text));
}

function sqlesc($value, $quotes = true)
{

	if (is_array($value))
	{
		foreach ($value as $key => $val)
		{
			$value[$key] = sqlesc($val);
		}
	}
	else
	{
		// Stripslashes (now done by unesc)
		if (get_magic_quotes_gpc())
			$value = stripslashes($value);
		// Escape and quote if not integer
		if (!is_numeric($value))
		{
			$value = @mysql_real_escape_string($value);
		}
      if($quotes)
   		$value = "'".$value."'";

	}
	return $value;
}

function admin()
{
   if($_SESSION['admin'] <= 7)
   {
      header("HTTP/1.0 404 Not Found");
      header("Location: /"); //404
      die();
   }
}
/*
function isadmin()
{
	if(!$_SESSION['admin'])
	{
		//header("Location: /"); //404
            header("HTTP/1.0 404 Not Found")
		die;
	}
}
*/

?>