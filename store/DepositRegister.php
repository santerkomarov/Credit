<?php  
require_once 'Connect.php';  

class DepositRegister { 

   private $conn; 

   function __construct() {  
      $db = new Connect();
      $this->conn = $db->connect;
   }  
   /**
   * Inserting deposit's data in DB
   */
   public function DepositRegister( $a,$b,$c,$d,$e,$f ) {
      $sql = "INSERT 
      INTO deposit (
         startDate,
         quantityOfMonths, 
         closeDate, 
         periodDeposit, 
         summaDeposit, 
         client_inn) 
      VALUES (?,?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$a,$b,$c,$d,$e,$f]);
      return false;
   }
}  
?>  