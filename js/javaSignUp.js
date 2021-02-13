
let emailIn = document.getElementById("signUpEmail");
let passwordIn = document.getElementById("signUpPass");
let stuId = document.getElementById("stuId");

let radAdmin = document.getElementById("radAdmin");
let radStudent = document.getElementById("radStudent");


let success = document.getElementById("success");
let emailAlert = document.getElementById("emailAlert");
let idAlert = document.getElementById("idAlert");




let signUpButton = document.getElementById("signUpButton");

let signInLink = document.getElementById("signInLink");

let radioBtn = document.getElementsByName("employees");

position();

/**if (localStorage.getItem("UserAccounts") == null) {
    var usersAcc = [];
}
else {
    usersAcc = JSON.parse(localStorage.getItem("UserAccounts"));
}**/






/**function addAcc() {
    accounts = {
        radio:"",
        email: emailIn.value,
        password: passwordIn.value,
        id:""
    };**/

    /**for (let i = 0; i < radioBtn.length; i++) {
        if (radioBtn[i].checked == true) {
            accounts.radio = radioBtn[i].value;
        };
    }**/

  /**   if(position()==true){
        accounts.id=stuId.value;
    } */

   

    let count = 0;
    let countId = 0;

  /**   for (let i = 0; i < usersAcc.length; i++) {

        if (emailIn.value == usersAcc[i].email) {
            count++;
        }
        if (stuId.value == usersAcc[i].id) {
            countId++;
        }


    }**/


  /**    if (count == 0) {
        emailIn.classList.remove("is-invalid");
        if (countId == 0) {
            if(stuId.classList.contains("d-none")){
            }
            else{
                stuId.classList.remove("is-invalid");
              
            }
            usersAcc.push(accounts);
            localStorage.setItem("UserAccounts", JSON.stringify(usersAcc));
           
        }
     /**    else {
            stuId.classList.add("is-invalid");
            idAlert.classList.remove("d-none");
            signUpButton.setAttribute("disabled", "true");
            idAlert.innerHTML="<strong>ID is Used</strong> "
        

    }**/

  /**   else {
        emailIn.classList.add("is-invalid");
        emailAlert.classList.remove("d-none");
        signUpButton.setAttribute("disabled", "true");
        emailAlert.innerHTML="<strong>Email is Used</strong> "
    }**/


    




function position (){
    for (let i = 0; i < radioBtn.length; i++) {
        radioBtn[i].addEventListener("click",()=>{
           if(radioBtn[i].value=="student"){
               stuId.classList.remove("d-none");
           }
           else{
            stuId.classList.add("d-none");
           }
        })
       
    }
    return true;
}



/**signUpButton.addEventListener("click", function () {
    addAcc();
    success.style.display = "block";
    signUpButton.style.margin = "0px 0";
    clear();
})**/

function validatestudentEmail() {
    success.style.display = "none";
    var emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    var emailValue = emailIn.value;
  
    if (emailRegex.test(emailValue)) {
        emailIn.classList.remove("is-invalid");
        emailIn.classList.add("is-valid");
        emailAlert.classList.add("d-none");
        signUpButton.removeAttribute("disabled");
  
    } else {
        emailIn.classList.add("is-invalid");
        emailAlert.classList.remove("d-none");
        signUpButton.setAttribute("disabled", "true");
  
    }
  }
  



  emailIn.addEventListener("keyup", validatestudentEmail);



  radAdmin.addEventListener("click", function () {
    idDisplay();
})

radStudent.addEventListener("click", function () {
    idDisplay();
})

function idDisplay(){
    console.log(yes)
   if(radAdmin.checked==true){
    stuId.classList.add("d-none")
    emailIn.classList.remove("d-none")
   }
   else if(radStudent.checked){
    stuId.classList.remove("d-none")
    emailIn.classList.add("d-none")
   }
}
idDisplay();

/**   function clear(){
    emailIn.value="";
    passwordIn.value="";
    stuId.value="";
  }**/

  