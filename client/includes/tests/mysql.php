<?php

require_once('test.php');

/**
* Generic Mysql Test class. Handles database-connection etc.
* 
* @package HostingSpeed
* @subpackage MysqlTests
*/
abstract class MysqlTest extends Test {
  
  /**
   * The name of the table to be used in the test.
   *
   * @since 0.1
   * @access protected
   * @var string
   */
   protected $table_name;
   
  /**
   * Constructor.
   *
   * @since 0.1
   */
  function __construct() {
    global $mysqli;
    
    # initiate database connection
    $mysqli = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
    
    if (mysqli_connect_errno()) {
      throw new Exception( "Unable to connect to database." );
    }
  }
  
  public function prepare() {
    global $mysqli;
    
    // Create a sandbox table.
    $query = sprintf(
      "CREATE TABLE `%s` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `testcolumn` VARCHAR( 255 ) NOT NULL
      ) ENGINE = MyISAM ",
      $this->table_name );

    if ( ! mysqli_query( $mysqli, $query ) === true )
      throw new Exception( "Could not create table." );
  }
  
  public function cleanup() {
    global $mysqli;
    
    // Drop sandbox database.
    
    $query = sprintf( "DROP TABLE `%s`", $this->table_name );
    if ( ! mysqli_query( $mysqli, $query ) === true )
      throw new Exception( "Could not drop table." );
  }
  
}

?>