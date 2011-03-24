<?php

require_once('config.php');
require_once('version.php');
require_once('tests.php');

/**
* The main class.
*
* @package Hostingspeed
*/
class Hostingspeed {
  
  /**
   * An array containing the tests to be run.
   *
   * @since 0.1
   * @var array
   */
  var $tests = array();
  
  /**
   * An array containing results from each test.
   *
   * @since 0.1
   * @var array
   */
  var $results = array();
  
  /**
   * Initializes all teste classes that are to be run.
   *
   * @since 0.1
   * @param array $tests An array of tests to be run.
   * @return void
   */
  public function load_tests( $tests ) {
    foreach ( $tests as $test_class ) {
      $this->tests[$test_class] = new $test_class;
    }
  }
  
  /**
   * Executes the tests.
   *
   * @since 0.1
   * @return void
   */
  public function execute() {
    foreach ( $this->tests as $test_class => $test ) {
      $test->prepare();
      $this->results[$test_class] = array( 
        "version" => $test->version(),
        "result" => $test->execute()
      );
      $test->cleanup();
    }
  }
  
  /**
   * Prints out a report from the gathered results
   *
   * @since 0.1
   * @return void
   */
  public function report() {
    global $hostingspeed_version;
    
    echo "Hostingspeed version: {$hostingspeed_version}";
    print_r( $this->results );
  }
  
}


?>
