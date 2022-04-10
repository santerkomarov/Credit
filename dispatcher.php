<?php
ob_start(); // for redirect, header(Location:...), ob_flush();

require_once "store/ClientRegister.php";
require_once "store/CreditRegister.php";
require_once "store/DepositRegister.php";
require_once 'store/Connect.php'; 

$clientHandler = new ClientRegister;
$creditHandler = new CreditRegister;
$depositHandler = new DepositRegister;

$d = new Connect();
$conn = $d->connect;

// count of rows in client table
$countOfClients = 0;
$quantity = $conn->query("SELECT * FROM clients")->fetchAll();
foreach ($quantity as $r) {
   $countOfClients += 1;
   // set limit for records in DB
   if ($countOfClients > 9) {
      header('Location: store/limit.php');
      exit;
   }
}

if ($_POST) {
   $client = test_input($_POST['client']); // person & company

   // personal data
   $LastName = test_input($_POST['LastName']);
   $FirstName = test_input($_POST['FirstName']);
   $Patronymics = test_input($_POST['Patronymics']);
   // passport data
   $PassportCode = test_input($_POST['PassportCode']);
   $PassportNumber = test_input($_POST['PassportNumber']);
   $PassportDate = test_input($_POST['PassportDate']);
   $Inn = test_input($_POST['Inn']);
   // company data
   $CompanyName = test_input($_POST['CompanyName']);
   $CompanyAddress = test_input($_POST['CompanyAddress']);
   $CompanyOGRN = test_input($_POST['CompanyOGRN']);
   $CompanyINN = test_input($_POST['CompanyINN']);
   $CompanyKPP = test_input($_POST['CompanyKPP']);

   $product = test_input($_POST['product']); // credit & deposit

   // dates data
   $startDate = test_input($_POST['startDate']);
   $quantityOfMonths = test_input($_POST['quantityOfMonths']); 
   $closeDate = test_input($_POST['closeDate']); 
   // credit data
   $paymentCredit = test_input($_POST['paymentCredit']); // График платежей
   $summaCredit = test_input($_POST['summaCredit']);
   // deposit data
   $periodDeposit = test_input($_POST['periodDeposit']); // Периодичность капитализации
   $summaDeposit = test_input($_POST['summaDeposit']); 
}

/**
 * sanitizing
 */
function test_input($data) {
   $data = trim($data);
   $data = strip_tags($data);
   $data = htmlspecialchars($data);
   return $data;
}

if ( $_POST['client'] ) {
   $clientHandler->ClientRegister(
      $client,
      $LastName,
      $FirstName, 
      $Patronymics, 
      $Inn,
      $PassportCode,
      $PassportNumber,
      $PassportDate,
      $CompanyName,
      $CompanyAddress,
      $CompanyOGRN,
      $CompanyINN,
      $CompanyKPP  
   );
}

if ( $_POST['product'] == "credit") {
   $creditHandler->CreditRegister(
      $startDate,
      $quantityOfMonths, 
      $closeDate, 
      $paymentCredit, 
      $summaCredit,
      $Inn
   );
}
if ( $_POST['product'] == "deposit") {
   $depositHandler->DepositRegister(
      $startDate,
      $quantityOfMonths, 
      $closeDate, 
      $periodDeposit,
      $summaDeposit,
      $Inn
   );
}

header("Location: ../show.php");
ob_flush();
