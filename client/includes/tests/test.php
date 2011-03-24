<?php

/**
 * The general Test class.
 *
 * @package hostingspeed
 * @since   0.1
 **/
abstract class Test {
  /**
   * Test version.
   *
   * @see version()
   * @since 0.1
   * @access protected
   * @var string
   */
   
  protected $version;
  
  /**
   * Returns the test version.
   *
   * @package hostingspeed
   * @since   0.1
   * @return  string
   */
   public function version() {
    return $this->version;
  }
  
  /**
   * Prepares the test for execution, if need be.
   *
   * @since 0.1
   * @return void
   */
  abstract public function prepare();
  
  /**
   * Executes the test, returning the test data.
   *
   * @package hostingpseed
   * @since   0.1
   * @return  mixed
   */
  abstract public function execute();
  
  /**
   * Cleans up afterwards, if need be.
   *
   * @since 0.1
   * @return void
   */
  abstract public function cleanup();
  
  
} // END interface


?>