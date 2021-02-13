

var fullName = document.getElementById("fullName"); 
var UserId = document.getElementById("UserId");
var grad = document.getElementById("grad");
var sub = document.getElementById("sub");
var midterm = document.getElementById("midterm");
var signOut=document.getElementById("signOut");
let position=document.getElementById("position");
var addBtn = document.getElementById("addstudent");

let emailUser =JSON.parse(localStorage.getItem("emailUser"));
let posisionUser =JSON.parse(localStorage.getItem("radio"));

var nameAlert=document.getElementById("nameAlert");
var idAlert=document.getElementById("idAlert");
var gradAlert=document.getElementById("gradAlert");
var midAlert=document.getElementById("midAlert");

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

function addstudent() {
  if (
    validatestudentName() == true &&
    UserId.value != "" &&
    grad.value != "" &&
    midterm.value != "" &&
    sub.value != ""&&
    UserId.value!=""
  ) {
    var student = {
      name: fullName.value,
      id: UserId.value,
      grad: grad.value,
      sub: sub.value,
      mid: midterm.value,
    };

    studentList.push(student);
    localStorage.setItem("studentData", JSON.stringify(studentList));
    clear();
    dispalystudents();
  }
}

function dispalystudents() {
  var trs = "";
  for (var i = 0; i < studentList.length; i++) {
    trs += `<tr><td>${studentList[i].id}</td><td>${studentList[i].name}</td><td>${studentList[i].mid}</td><td>${studentList[i].grad}</td><td>${studentList[i].sub}</td>
    <td>
    <button class="btn btn-danger" onclick="deletestudent(${i})">delete</button>
</td>
<td>
    <button onclick="retriveData(${i})" class="btn btn-warning">update</button>
</td>


    </tr>`;
  }

  document.getElementById("tbody").innerHTML = trs;
}

dispalystudents();


function deletestudent(x) {
  studentList.splice(x, 1);

  localStorage.setItem("studentData", JSON.stringify(studentList));
  dispalystudents();
}

var searchInp = document.getElementById("search");

function search() {

  var trs = "";
  for (var i = 0; i < studentList.length; i++) {
    if (
      studentList[i].id.includes(searchInp.value)
    ) {
      trs += `<tr><td>${studentList[i].id.replace(
        searchInp.value,
        `<span style="background-color: yellow;">${searchInp.value}</span>`
      )}</td><td>${studentList[i].name}</td><td>${studentList[i].mid}</td><td>${studentList[i].grad
        }</td><td>${studentList[i].sub}</td>
      <td>
      <button class="btn btn-danger" onclick="deletestudent(${i})">delete</button>
  </td>
  <td>
      <button class="btn btn-warning">update</button>
  </td>
  
  
      </tr>`;
    }
  }
  document.getElementById("tbody").innerHTML = trs;
}




function retriveData(x) {
  fullName.value = studentList[x].name;
  UserId.value = studentList[x].id;
  grad.value = studentList[x].grad;
  sub.value = studentList[x].sub;
  midterm.value = studentList[x].mid;
  addBtn.innerHTML = "update student";

  addBtn.onclick = function () {
    studentList[x].name = fullName.value;
    studentList[x].id = UserId.value;
    studentList[x].grad = grad.value;
    studentList[x].sub = sub.value;
    studentList[x].mid = midterm.value;

    localStorage.setItem("studentData", JSON.stringify(studentList));

    dispalystudents();

    addBtn.innerHTML = "add student";

    addBtn.onclick = addstudent;
  };
}

var alert = document.getElementById("nameAlert");





function validatestudentName() {
  var nameRegex = /[a-z 0-9]{1,15}$/;
  var nameValue = fullName.value;

  if (nameRegex.test(nameValue)) {
    fullName.classList.remove("is-invalid");
    fullName.classList.add("is-valid");
    nameAlert.classList.add("d-none");
    addBtn.removeAttribute("disabled");

    return true;
  } else {
    fullName.classList.add("is-invalid");
    nameAlert.classList.remove("d-none");
    addBtn.setAttribute("disabled", "true");

    return false;
  }
}


function validatestudentId() {
  var idRegex = /^([0-9]{1,8})$/;
  var idValue = UserId.value;

  if (idRegex.test(idValue)) {
    UserId.classList.remove("is-invalid");
    UserId.classList.add("is-valid");
    idAlert.classList.add("d-none");
    addBtn.removeAttribute("disabled");

    return true;
  } else {
    UserId.classList.add("is-invalid");
    idAlert.classList.remove("d-none");
    addBtn.setAttribute("disabled", "true");

    return false;
  }
}


function validatestudentMid() {
  var midRegex = /^([0-5]{1,2}|60|6|7|8|9)$/;
  var midValue = midterm.value;

  if (midRegex.test(midValue)) {
    midterm.classList.remove("is-invalid");
    midterm.classList.add("is-valid");
    midAlert.classList.add("d-none");
    addBtn.removeAttribute("disabled");

    return true;
  } else {
    midterm.classList.add("is-invalid");
    midAlert.classList.remove("d-none");
    addBtn.setAttribute("disabled", "true");

    return false;
  }
}


function validatestudentgrad() {
  
  var gradRegex = /^(100|[0-9]{1,2})$/;
  var gradValue = grad.value;

  if (gradRegex.test(gradValue)) {
    grad.classList.remove("is-invalid");
    grad.classList.add("is-valid");
    gradAlert.classList.add("d-none");
    addBtn.removeAttribute("disabled");

    return true;
  } else {
    grad.classList.add("is-invalid");
    gradAlert.classList.remove("d-none");
    addBtn.setAttribute("disabled", "true");

    return false;
  }
}

fullName.addEventListener("keyup", validatestudentName);
UserId.addEventListener("keyup", validatestudentId);
midterm.addEventListener("keyup", validatestudentMid);
grad.addEventListener("keyup", validatestudentgrad);

signOut.addEventListener("click",function(){
  localStorage.removeItem("emailUser");
  localStorage.removeItem("radio");
  localStorage.removeItem("ID");
  window.location.href="index.html";
})

function clear(){
  fullName.value="";
  UserId.value="";
  grad.value="";
  midterm.value="";
  sub.value="";
     
   fullName.classList.remove("is-valid");
   UserId.classList.remove("is-valid");
   sub.classList.remove("is-valid");
   midterm.classList.remove("is-valid");
   grad.classList.remove("is-valid");
}
