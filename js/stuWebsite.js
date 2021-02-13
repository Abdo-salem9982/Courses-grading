

var fullName = document.getElementById("fullName"); 
var UserId = document.getElementById("UserId");
var grad = document.getElementById("grad");
var sub = document.getElementById("sub");
var midterm = document.getElementById("midterm");
var signOut=document.getElementById("signOut");

var emailUser =JSON.parse(localStorage.getItem("emailUser"));
var posisionUser =JSON.parse(localStorage.getItem("radio"));


if (localStorage.getItem("studentData") == null) {
  var studentList = [];
} else {
  var studentList = JSON.parse(localStorage.getItem("studentData"));
}

if (localStorage.getItem("ID") == null) {
  var ids = [];
} else {
  var ids = JSON.parse(localStorage.getItem("ID"));
}

dispalystudents();

function dispalystudents() {
  var trs = "";
  for (var i = 0; i < studentList.length; i++) {
    if(ids==studentList[i].id){
      trs += `<tr><td>${studentList[i].id}</td><td>${studentList[i].name}</td><td>${studentList[i].mid}</td><td>${studentList[i].grad}</td><td>${studentList[i].sub}</td>
    </tr>`;
    }
    
  }

  document.getElementById("tbody").innerHTML = trs;
}


signOut.addEventListener("click",function(){
  localStorage.removeItem("emailUser");
  localStorage.removeItem("radio");
  localStorage.removeItem("ID");
  window.location.href="index.html";
})











