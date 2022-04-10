<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/png" href="images/coins.png" />
   <title>Bank Glob</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
   <div class="w-50 mx-auto mb-4">
      <h4 class="text-center">Форма для заполнения заявки на получение кредита и открытия вклада.</h4>
   </div>
   <div style="max-width:1000px;margin:0 auto;">
      <form id="form" action="dispatcher.php" method="POST">
         <h5 class="text-center mb-4">Заявка заполняется на </h5>
         <div class="d-flex justify-content-center mb-5">
            <div class="form-check me-5">
               <input class="form-check-input " role="button" type="radio" name="client" id="personal" value="personal" checked>
               <label class="form-check-label" role="button" for="personal">
               Физическое лицо
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" role="button" type="radio" name="client" id="company" value="company">
               <label class="form-check-label" role="button" for="company">
               Юридическое лицо
               </label>
            </div>
         </div>

         <div style="max-width:700px;margin:0 auto;">
            <div class="d-flex justify-content-between mt-3">
               <div class="form-floating me-2">
                  <input type="text" class="form-control fio" name="LastName" placeholder="фамилия" required>
                  <label class="text-secondary">фамилия</label>
               </div>
               <div class="form-floating me-2">
                  <input type="text" class="form-control fio" name="FirstName" placeholder="имя" required>
                  <label class="text-secondary">имя</label>
               </div>
               <div class="form-floating">
                  <input type="text" class="form-control fio" name="Patronymics"  placeholder="отчество" required>
                  <label class="text-secondary">отчество</label>
               </div>
            </div>
            <div class="mt-3 mb-4" style="max-width:207px;">
               <div class="form-floating">
                     <input type="text" class="form-control digital" name="Inn" placeholder="ИНН" id="inn" required>
                     <label class="text-secondary">инн</label>
                  </div>
            </div>

            <div id="passportData">
               <span class="">паспортные данные</span>
               <div class="d-flex justify-content-between mt-2" >
                  <div class="form-floating me-2">
                     <input type="text"  name="PassportCode" class="form-control  passport digital" placeholder="серия">
                     <label class="text-secondary">серия</label>
                  </div>
                  <div class="form-floating me-2">
                     <input type="text"  name="PassportNumber" class="form-control  passport digital" placeholder="номер">
                     <label class="text-secondary">номер</label>
                  </div>
                  <div class="form-floating">
                     <input type="text"  name="PassportDate" id="PassportDate" class="form-control passport " placeholder="дата выдачи" maxlength="100">
                     <label class="text-secondary" >дата выдачи</label>
                  </div>
               </div>
            </div>

            <div class="mt-4" id="companyData">
               <p>данные организации</p>
               <div class="d-flex flex-column mt-3">
                  <div class="form-floating mb-3">
                     <input type="text"  name="CompanyName" class="form-control company" placeholder="наименование">
                     <label class="text-secondary">наименование</label>
                  </div>
                  <div class="form-floating mb-3">
                     <input type="text"  name="CompanyAddress" class="form-control company" placeholder="адрес">
                     <label class="text-secondary">адрес</label>
                  </div>
               </div>
               
               <div class="d-flex justify-content-between" >
                  <div class="form-floating me-2">
                     <input type="text"  name="CompanyOGRN" class="form-control company digital" placeholder="ОГРН">
                     <label class="text-secondary">ОГРН</label>
                  </div>
                  <div class="form-floating me-2">
                     <input type="text"  name="CompanyINN" class="form-control company digital" placeholder="ИНН">
                     <label class="text-secondary">ИНН</label>
                  </div>
                  <div class="form-floating">
                     <input type="text"  name="CompanyKPP" class="form-control company digital" placeholder="КПП">
                     <label class="text-secondary">КПП</label>
                  </div>
               </div>
            </div>
         </div>

         <h5 class="text-center mt-5 mb-3">Выберите продукт</h5>
         <div class="d-flex justify-content-center mb-4">
            <div class="form-check me-5">
               <input class="form-check-input " role="button" type="radio" name="product" id="credit" value="credit" checked>
               <label class="form-check-label" role="button" for="credit">
               Кредит
               </label>
            </div>
            <div class="form-check">
               <input class="form-check-input" role="button" type="radio" name="product" id="deposit" value="deposit">
               <label class="form-check-label" role="button" for="deposit">
               Вклад
               </label>
            </div>
         </div>

         <div style="max-width:700px;margin:0 auto;">
            <div class="d-flex justify-content-between mb-4">
            <div class="col-lg-3 col-sm-6">
               <label for="startDate">Дата открытия</label>
               <input id="startDate" name="startDate" class="form-control" value ="<?= date("Y-m-d") ?>" type="date" />
               <span id="startDateSelected"></span>
            </div>
            <div>
               <span>Количество месяцев</span>
               <select id="quantityOfMonths" name="quantityOfMonths" class="form-select">
                  <option value="0" selected></option>
                  <option value="1">один</option>
                  <option value="2">два</option>
                  <option value="3">три</option>
                  <option value="4">четыре</option>
                  <option value="5">пять</option>
                  <option value="6">шесть</option>
                  <option value="7">семь</option>
                  <option value="8">восемь</option>
                  <option value="9">девять</option>
                  <option value="10">десять</option>
                  <option value="11">одиннадцать</option>
                  <option value="12">двенадцать</option>
               </select>
            </div>
            <div class="mb-3">
               <label for="exampleFormControlInput1" class="">Дата закрытия</label>
               <div class="form-control" id="dateOfClose" style="height:38px;min-width:160px;"></div>
               <input type="text" id="dateOfClose2" name="closeDate" value="NULL" hidden>
            </div>
         </div>
         <div id="blockCredit">
            <div class="input-group mb-5">
               <label class="input-group-text" for="inputGroupSelect01">График платежей</label>
               <div class="form-select d-flex justify-content-around" style="background-image: none;">
                  <div class="form-check me-5">
                     <input class="form-check-input" role="button" type="radio" name="paymentCredit" value="annuity" id="paymentCredit1"checked>
                     <label class="form-check-label" role="button" for="paymentCredit1">
                     аннуитетный
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" role="button" type="radio" name="paymentCredit" value="differentiated" id="paymentCredit2">
                     <label class="form-check-label" role="button" for="paymentCredit2">
                     дифференцированный
                     </label>
                  </div>
               </div>
            </div>

            <div class="mt-4 mb-5">
               <div class="input-group">
                  <span class="input-group-text" id="inputGroupPrepend2">Сумма кредита</span>
                  <input type="text" class="form-control" id="summaCredit"  name="summaCredit" placeholder="1000 руб." onblur="convertToMoneyFormat()">
               </div>
            </div>
         </div>

         <div  id="blockDeposit">
            <div class="input-group mb-5">
            <label class="input-group-text" for="inputGroupSelect01">Периодичность капитализации</label>
               <div class="form-select d-flex justify-content-around" style="background-image: none;">
                  <div class="form-check me-5">
                     <input class="form-check-input" role="button" type="radio" name="periodDeposit" value="end of date" id="periodCapital1" checked>
                     <label class="form-check-label" role="button" for="periodCapital1">
                     в конце срока
                     </label>
                  </div>
                  <div class="form-check">
                     <input class="form-check-input" role="button" type="radio" name="periodDeposit" value="quarterly" id="periodCapital2">
                     <label class="form-check-label" role="button" for="periodCapital2">
                     ежеквартально
                     </label>
                  </div>
               </div>
            </div>

            <div class="input-group mb-5">
               <label class="input-group-text" >Выберите ставку вклада</label>
               <select class="form-select" name="summaDeposit" id="summaDeposit">
                  <option value="" selected></option>
                  <option value="10%" >Класс - 10%</option>
                  <option value="20%">Супер - 20%</option>
                  <option value="30%">Мега - 30%</option>
               </select>
            </div>
         </div> 
      </div>
      
      <div class="d-flex justify-content-center">
         <input id="btnSend2" class="text-center btn btn-primary" type="button" value="оформить заявку">
      </div>
         
   </form>

   <div class="d-flex justify-content-center my-4">
      <a class="btn btn-success" href="show.php" target="_blank" rel="noopener nofollow" >перейти к просмотру заявок из базы данных</a>
   </div>

<script src="script/script.js"></script>

</body>
</html>