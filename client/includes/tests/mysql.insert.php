<?php

require_once('mysql.php');

/**
* MySQL insert test
* 
* @package Hostingspeed
* @subpackage MysqlTests
*/
class MysqlInsertTest extends MysqlTest {
  
  protected $version = "0.1";
  protected $table_name = "mysql_insert_test";
  
  private $iterations = 1000;
  private $strings;
  
  public function prepare() {
    parent::prepare();
    
    // Generate an array of random strings for insertion.
    $this->strings = array();

    for ($i = 0; $i < $this->iterations; $i++) {

       $length = mt_rand(5, 15);
       $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
       $string='';

       for ($p = 0; $p < $length; $p++) {
          $string .= $characters[mt_rand(0, strlen($characters)-1)];
       }

       $this->strings[$i]['s'] = $string;
       $this->strings[$i]['l'] = $length;
    }
  }
  
  public function execute() {
    global $mysqli;
    
    //Timer Start
    $time_start = microtime( true );

    //Perform test - INSERT
    for ($i = 0; $i < $this->iterations; $i++) {
      $query = sprintf(
        "INSERT INTO `%s` (`id`, `testcolumn`) VALUES(%i, '%s')",
        $this->table_name, $i, $this->strings[$i]['s'] );
        
      mysqli_query( $mysqli, $query );
    }
    
    //Timer end
    $time_end = microtime( true );
    
    //Time lapsed
    $time_lapsed = $time_end - $time_start;
    
    //Operations per second
    $power = $this->iterations / $time_lapsed;
    
    return array( "Insertions per second" => $power );
  }
  
}

?>