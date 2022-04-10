<?php  
require_once 'Connect.php';  
class ClientRegister {  
   private $conn; 
   function __construct() {  
      // connect with DB 
      $db = new Connect();
      $this->conn = $db->connect;
      
   }  
   /**
   * Inserting client's data in DB
   */
   public function ClientRegister( $a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m ) {
      $sql = "INSERT 
      INTO clients (
         client,
         LastName,
         FirstName, 
         Patronymics, 
         Inn, 
         PassportCode, 
         PassportNumber, 
         PassportDate,
         CompanyName,
         CompanyAddress,
         CompanyOGRN,
         CompanyINN,
         CompanyKPP ) 
      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$a,$b,$c,$d,$e,$f,$g,$h,$i,$j,$k,$l,$m]);
      
      return false;
   }
}  
?>  