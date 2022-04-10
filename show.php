<?php
require_once 'store/Connect.php'; 
$c = new Connect();
$conn = $c->connect;

$data = $conn->query("SELECT * FROM clients")->fetchAll();
foreach ($data as $row) {}
$dataCredit = $conn->query("SELECT * FROM credit")->fetchAll();
foreach ($dataCredit as $row) {}
$dataDeposit = $conn->query("SELECT * FROM deposit")->fetchAll();
foreach ($dataDeposit as $row) {}

// count of rows in client table
$countOfClients = 0;
$quantity = $conn->query("SELECT * FROM clients")->fetchAll();
foreach ($quantity as $r) { $countOfClients += 1;}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="images/coins.png" />
   <title>Таблица заявок</title>
   <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
   <style>
      body {
         font-family: "Roboto", sans-serif;
      }
      .content {
         max-width:1000px;
         margin:0 auto;
      }
      table {
         border-collapse: collapse;
         width: 100%;
         margin-bottom: 30px;
      }
      td, th {
         font-size: 12px;
         border: 1px solid #003366;
         text-align: left;
         padding: 3px;
      }
      th {
         background-color: #999;
         font-size: 0.75em;
      }
      tr:nth-child(even) {
         background-color: #dddddd;
      }
      tr td a {
         color: red;
      }
      .h1-span {
         font-size: 12px;
      }
      .link {
         font-size:16px;
      }
      .unique {
         background-color: #98FB98;
      }
   </style>
</head>
<body>
   <div class="wrap">
      <div class="content">
      <h1>Таблица заявок клиентов</h1>
      <span class="h1-span">(максимальное количество записей: 10шт.)</span>
		<table>
			<tr>
            <th>№</th>
            <th>Клиент</th>
				<th>фамилия</th>
				<th>Имя</th>
				<th>Отчество</th>
				<th class="unique">ИНН/ключ</th>
				<th>Серия паспорта</th>
				<th>Номер паспорта</th>
            <th>Дата выдачи</th>
            <th>Название компании</th>
            <th>Адрес компании</th>
            <th>ОГРН</th>
            <th>ИНН</th>
            <th>КПП</th>
            <th></th>
			</tr>
			<?php
				if ( !empty($data) ) {
               $numberRow = 1;
               foreach ($data as $row) { 
			?>	
				<tr>
               <td><?php echo $numberRow?></td>
               <td><?php echo $row['client']?></td>
					<td><?php echo $row['LastName']?></td>
               <td><?php echo $row['FirstName']?></td>
               <td><?php echo $row['Patronymics']?></td>
               <td class="unique"><?php echo $row['Inn']?></td>
               <td><?php echo $row['PassportCode']?></td>
               <td><?php echo $row['PassportNumber']?></td>
               <td><?php echo $row['PassportDate']?></td>
               <td><?php echo $row['CompanyName']?></td>
               <td><?php echo $row['CompanyAddress']?></td>
               <td><?php echo $row['CompanyOGRN']?></td>
               <td><?php echo $row['CompanyINN']?></td>
               <td><?php echo $row['CompanyKPP']?></td>
               <td>
                  <a href="store/delete.php?id=<?php echo $row['id'] ?>"><?php echo 'удалить'?>
               </a></td>
				</tr>
			<?php
            $numberRow += 1;
				}
			}
			?>
		</table>

      <h4>Таблица кредитов</h4>
      <table>
			<tr>
            <th>Дата выдачи</th>
				<th>Количество месяцев</th>
				<th>Дата закрытия</th>
            <th>График платежей</th>
				<th>Сумма кредита</th>
				<th>Инн клиента</th>
			</tr>
			<?php
			if ( !empty($dataCredit) ) {
            foreach ($dataCredit as $row) { 
			?>	
			<tr>
            <td><?php echo $row['startDate']?></td>
				<td><?php echo $row['quantityOfMonths']?></td>
            <td><?php echo $row['closeDate']?></td>
            <td><?php echo $row['paymentCredit']?></td>
            <td><?php echo $row['summaCredit']?></td>
            <td><?php echo $row['client_inn']?></td>
			</tr>
			<?php
				}
			}
			?>
		</table>

      <h4>Таблица депозитов</h4>
      <table>
			<tr>
            <th>Дата выдачи</th>
				<th>Количество месяцев</th>
				<th>Дата закрытия</th>
            <th>Период капитализации</th>
				<th>Ставка депозита</th>
				<th>Инн клиента</th>
			</tr>
			<?php
			if ( !empty($dataDeposit) ) {
            foreach ($dataDeposit as $row) { 
			?>	
			<tr>
            <td><?php echo $row['startDate']?></td>
				<td><?php echo $row['quantityOfMonths']?></td>
            <td><?php echo $row['closeDate']?></td>
            <td><?php echo $row['periodDeposit']?></td>
            <td><?php echo $row['summaDeposit']?></td>
            <td><?php echo $row['client_inn']?></td>
			</tr>
			<?php
				}
			}
			?>
		</table>
      <a class="link" href="index.php">вернуться на главную</a>
	</div>
   
</body>
</html>