
const from = document.getElementById('form')
const startDate = document.getElementById('startDate')
const quantityOfMonths = document.getElementById("quantityOfMonths")
const dateOfClose = document.getElementById('dateOfClose')// display on html page
const dateOfClose2 = document.getElementById('dateOfClose2') // format for DB

const companyData = document.getElementById('companyData')
companyData.style.display = "none"; // default

const passportData = document.getElementById('passportData')
passportData.style.display = "block"; // default

const passportDate = document.getElementById('PassportDate')
const credit = document.getElementById('credit')
const summaCredit = document.getElementById('summaCredit')
const summaDeposit = document.getElementById('summaDeposit')

const blockCredit = document.getElementById('blockCredit')
blockCredit.style.display = "none"; // default, hide block at loading page

const deposit = document.getElementById('deposit')

const blockDeposit = document.getElementById('blockDeposit')
blockDeposit.style.display = "none"; // default, hide block at loading page

const btnSend2 = document.getElementById('btnSend2')

const fio = document.querySelectorAll('.fio')
const company = document.querySelectorAll('.company')
const passport = document.querySelectorAll('.passport')

function addMonths(date, months) {
   var d = date.getDate()
   date.setMonth(date.getMonth() + +months)
   if (date.getDate() != d) {
      date.setDate(0)
   }
   return date
}
   
quantityOfMonths.addEventListener('change',(e)=>{
   let monthes = e.target.value
   let d = new Date(startDate.value)
   d = addMonths(d,monthes)  
   d.setDate(d.getDate())

   // format for DB
   endDatePHP = d.getFullYear() + '-' 
      + ('0' + (d.getMonth()+1)).slice(-2) + '-' 
      + ('0' + d.getDate()).slice(-2)

   // format for HTML
   endDateHTML = ('0' + d.getDate()).slice(-2) + '.'
      + ('0' + (d.getMonth()+1)).slice(-2) + '.'
      + d.getFullYear()

   dateOfClose.innerText = endDateHTML
   dateOfClose2.value  = endDatePHP
})

// check person data (LastName, FirstName, Patronymics, INN )
function isPersonalDataEmpty() {
   let f = 4 // numbers of fields
   fio[0].value ? f -=1 : false // minus 1 if field have value
   fio[1].value ? f -=1 : false
   fio[2].value ? f -=1 : false
   digitalInputs[0].value ? f -= 1 : false
   return Boolean(f) // convert to boolean
}

// check passport data (PassportCode, PassportNumber, PassportDate)
function isPassportDataEmpty() {
   let f = 3 // numbers of fields
   digitalInputs[1].value ? f -=1 : false // minus 1 if field have value
   digitalInputs[2].value ? f -=1 : false
   passportDate.value ? f -=1 : false
   return Boolean(f)
}

// clearing field's value
// passport $ company data
function clearField (field) {
   let c = document.querySelectorAll(`.${field}`);
   for (let i = 0; i < c.length; i++) {
      c[i].value = ""
   }
}

function isProductValueEmpty (arg) {
   let proxy;
   arg == "Deposit" ? proxy = summaDeposit.value : proxy = summaCredit.value
   if ( dateOfClose2.value && proxy ) {
      return false
   }
   return true
}

// check company fields. Are there empty?
// return boolean. TRUE - empty one or more field. False - all fields are with value.
function isCompanyFieldsValueEmpty () {
   for (let i = 0; i < company.length; i++) {
      if ( !company[i].value ) { 
         return true
      }
   }
   return false
}
// -- listening radio check box CLIENT---       
const radioButtons = document.querySelectorAll('input[name="client"]')
for (const radioButton of radioButtons){
   if (radioButton.checked) {
      client = radioButton.value
      console.log('radioButton.value checked: ' + radioButton.value)
   }
   radioButton.addEventListener('change', function(e) {
      if ( radioButton.value == "company" ) {
         companyData.style.display = "block"
         //fio.innerHTML = "фио \<br\>руководителя"
         passportData.style.display = "none"
      } else {
         passportData.style.display = "block"
         //fio.innerHTML = "фио"
         companyData.style.display = "none"
      }
   });
} 

// class .digital allow to fillonly digital values
const digitalInputs = document.querySelectorAll('.digital')
var oldDigitalValue = ""
for (const digitalInput of digitalInputs){
   digitalInput.addEventListener('input', function(e) {
      if ( checkForNumber(digitalInput.name, digitalInput.value) ) {
         // update old value with new value
         oldDigitalValue = digitalInput.value
      } else {
         // set value to last known valid value
         digitalInput.value = oldDigitalValue
      }  
   });
}

// return boolean
// first argument is name of checking input,
// second argument is input's value
function checkForNumber(field,str) {
   let regExp;
   // limit maxlength, only numbers
   let personInn = /^[0-9]{0,12}$/ 
   let passportCode = /^[0-9]{0,4}$/ // серия паспорта
   let passportNumber = /^[0-9]{0,6}$/ // номер пспорта
   let companyINN = /^[0-9]{0,10}$/
   let companyOGRN = /^[0-9]{0,13}$/ 
   let companyKPP = /^[0-9]{0,9}$/ 

   if (field == "Inn") {
      regExp = personInn;
   } else if (field == "PassportCode" ) {
      regExp = passportCode
   } else if (field == "PassportNumber" ) {
      regExp = passportNumber
   } else if (field == "CompanyOGRN" ) {
      regExp = companyOGRN
   } else if (field == "CompanyINN" ) {
      regExp = companyINN
   } else if (field == "CompanyKPP" ) {
      regExp = companyKPP
   }
   
   return regExp.test(str)
}

// switch between credit & deposit fields, radiobutton       
const products = document.querySelectorAll('input[name="product"]')
for (const product of products){
   if ( product.checked && product.value == "credit" ) {
         blockCredit.style.display = "block"
         blockDeposit.style.display = "none"
   }
   product.addEventListener('change', function(e) {
      if ( product.value == "credit" ) {
         blockCredit.style.display = "block"
         blockDeposit.style.display = "none"
         
      } else {
         blockCredit.style.display = "none"
         blockDeposit.style.display = "block"
      }
   });
} 

// convert summaCredit input into numbers
var oldCreditValue = ""
summaCredit.addEventListener('input', function(e) {

   // " /^[0-9]{0,13}$/.test(arg) " return TRUE if digital
   if ( /^[0-9]{0,13}$/.test(summaCredit.value) ) {
         // update old value with new value
         oldCreditValue = summaCredit.value
      } else {
         // set value to last known valid value
         summaCredit.value = oldCreditValue
      }
})
// convert 10000 into 10 000 ₽ 
function convertToMoneyFormat() {
   let i = parseInt(summaCredit.value);
   summaCredit.value = i.toLocaleString("ru-RU", {style:"currency", currency:"RUB"})
}

btnSend2.addEventListener("click", function(event){
   if ( checkForm() ) {
      form.submit()
   }
});

// return boolean
// TRUE means all inputs are filled
function checkForm() {
   let checkClient = false

   if ( radioButtons[0].checked ) { // "personal" is checked
      // check all personal data & passport are not empty
      if ( !isPersonalDataEmpty() && !isPassportDataEmpty()) {
         checkClient = true
      } else {
         alert('Не заполнены все поля с персональными данными')
      }
      clearField("company")
   } else if ( radioButtons[1].checked ) { // "company" is checked
      // check all personal data & company data are not empty
      if ( !isPersonalDataEmpty() && !isCompanyFieldsValueEmpty()) {
         checkClient = true
      } else {
         alert('Не заполнены все поля с данными компании ')
      }
      clearField("passport")
   }

   // check PRODUCT block, credit & deposit
   let checkProduct= false

   if ( products[0].checked) { // "credit" is checked
      if ( !isProductValueEmpty("Credit")) {
         checkProduct = true
      } else {
         alert('Не выбран срок кредита или сумма кредита')
         checkProduct = false
      }

   } else if ( products[1].checked) { // "deposit" is checked
      if ( !isProductValueEmpty("Deposit")) {
         checkProduct = true
      } else {
         alert('Не выбран срок депозита или сумма депозита')
         checkProduct = false
      }
   }
   // check two blocks, client & product
   // when all validations done, go submit form
   if ( checkClient && checkProduct ) {
      return true
   } 
   return false
}
