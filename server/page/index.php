<?php

require_once("../includes/include.php");
//init();

getHeader("Index");

?>
<a href="http://client.hostingspeed.se/">Klient</a>


<table border="1" cellspacing="0" cellpadding="10">
   <tr>
      <td>Webbhotell</td>
      <td>Test1</td>
      <td>Test2</td>
      <td>Test3</td>
   </tr>
<?
$s = $dbh->prepare("SELECT testhosts.*, webhosts.name AS webhostname FROM results JOIN webhosts ON testhosts.webhost = webhosts.id ORDER BY name DESC");
$s->execute();

foreach($s->fetchAll() as $r)
{
?>
   <tr>
      <td><?=$r['webhostname']?></td>
      <td><?=$r['test1']?></td>
      <td><?=$r['test2']?></td>
      <td><?=$r['test3']?></td>
   </tr>
<?
}

?>
</table>
   
   