<?php  
   class Connect {  

      private $host = 'localhost';
      private $username = 'root';
      private $password = 'root';
      private $database = 'db';
      private $charset = 'utf8mb4';
      
      private $dsn;
      private $options;
      public $connect;

      function __construct() {  

         $this->dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";
         $this->options = [
         PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_EMULATE_PREPARES   => false,
         ];
         
         try {
            $this->connect = new PDO($this->dsn, $this->username, $this->password, $this->options);
         } catch (\PDOException $e) {
            echo "no DB available<br>";
         } 
         return $this->connect;  
      }   
   }