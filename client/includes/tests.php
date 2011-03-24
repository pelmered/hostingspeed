<?php

// Include all available test classes.
foreach ( glob( "includes/tests/*.php" ) as $test ) {
   include_once( $test );
}

?>