<?php  
require_once 'Connect.php';  

class CreditRegister { 

   private $conn; 

   function __construct() {  
      // connect with DB 
      $db = new Connect();
      $this->conn = $db->connect;
   }  
   /**
   * Inserting credit's data in DB
   */
   public function CreditRegister( $a,$b,$c,$d,$e,$f ) {
      $sql = "INSERT 
      INTO credit (
         startDate,
         quantityOfMonths, 
         closeDate, 
         paymentCredit, 
         summaCredit, 
         client_inn) 
      VALUES (?,?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$a,$b,$c,$d,$e,$f]);
      
      return false;
   }
}  
?>  