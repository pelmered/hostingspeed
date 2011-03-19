<?php
/**
* Description of Log
*
* @author Peter
*/
class ErrorLog
{
   var $error;

   /**
   * Constuructor
   * Needs the $_FILES array on fileupload
   *
   * @param array $_FILES The $_FILES array
   * @param String/array
   */
   function __construct(  )
   {
      
   }

   /**
   * getError
   * Gets last error
   *
   * @return String $error Error message
   */
   function getError()
   {
      return $this->error;
   }

   /**
   * Description of method
   *
   * @param type desc
   * @param type desc
    *
    * @return bool desc
   */
   function write()
   {
      return true;
   }
}
?>
