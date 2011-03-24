<?php

ini_set('display_errors', 1);
ini_set('log_errors', 0);

require_once('includes/hostingspeed.php');

$hostingspeed = new Hostingspeed();

// Select which tests to run. This should be done through the request URI or the CLI.
$hostingspeed->load_tests( array( 
  'MysqlInsertTest'
));

// Run the tests.
$hostingspeed->execute();

// Print out a report with test results.
$hostingspeed->report();

?>