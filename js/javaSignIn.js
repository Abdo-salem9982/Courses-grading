let emailIn = document.getElementById("signInEmail");
let passwordIn = document.getElementById("signInPass");
let stuId = document.getElementById("stuId");
let radAdmin = document.getElementById("radAdmin");
let radStudent = document.getElementById("radStudent");

let signInButton = document.getElementById("signInButton");
let signUpButton = document.getElementById("signUpButton");

let emailAlert = document.getElementById("emailAlert");
let passAlert = document.getElementById("passAlert");

let success = document.getElementById("success");

let radio = [];


if (localStorage.getItem("UserAccounts") == null) {
    console.log("no")
}
else {
    var usersAcc = [];
    usersAcc = JSON.parse(localStorage.getItem("UserAccounts"));
}

usersAcc = JSON.parse(localStorage.getItem("UserAccounts"));





signInButton.addEventListener("click", function () {
    login();
})

signUpButton.addEventListener("click", function () {
    window.location.href = "SignUp.html";
})

function login() {
    let userEmail = "";
    var userName = "";
    for (var i = 0; i < usersAcc.length; i++) {
        if (usersAcc[i].email == emailIn.value) {
            userEmail = emailIn.value;
            userName = usersAcc[i].name;
            var emailIndex = i;
        }
    }
    if (userEmail != "") {

        if (usersAcc[emailIndex].password == passwordIn.value) {
            if (usersAcc[emailIndex].radio == "admin") {
                success.style.display = "block";
                window.location.href = "website.html";
                localStorage.setItem("emailUser", JSON.stringify(usersAcc[emailIndex].email));
                localStorage.setItem("radio", JSON.stringify(usersAcc[emailIndex].radio));
                localStorage.setItem("ID", JSON.stringify(usersAcc[emailIndex].id));

            }
            else if (usersAcc[emailIndex].radio == "student") {
                success.style.display = "block";
                window.location.href = "stuWebsite.html";
                localStorage.setItem("emailUser", JSON.stringify(usersAcc[emailIndex].email));
                localStorage.setItem("radio", JSON.stringify(usersAcc[emailIndex].radio));
                localStorage.setItem("ID", JSON.stringify(usersAcc[emailIndex].id));

            }

        }

        else {
            passAlert.classList.remove("d-none");
            passwordIn.classList.add("is-invalid");



        }
    }
    if (userEmail == "") {

        emailAlert.classList.remove("d-none");
        emailIn.classList.add("is-invalid");

    }




    clearForm();

}

radAdmin.addEventListener("click", function () {
    idDisplay();
})

radStudent.addEventListener("click", function () {
    idDisplay();
})

function idDisplay(){
   if(radAdmin.checked==true){
    stuId.classList.add("d-none")
    emailIn.classList.remove("d-none")
   }
   else if(radStudent.checked){
    stuId.classList.remove("d-none")
    emailIn.classList.add("d-none")
   }
}



function clearForm() {
    emailIn.value = "";
    passwordIn.value = "";
}
