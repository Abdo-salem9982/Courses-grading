<?php
require("db.php");
if(isset($_COOKIE['user_session']))
{
  $cook=$_COOKIE['user_session'];
  $check_admin_query="select * from admins Where session_id='$cook'";
  $check_admin_query_results=$conn->query($check_admin_query);
  if(!$check_admin_query_results->num_rows > 0)
  {
    header("location:index.php");
  }
}
else
{
  header("location:index.php");
}
$aid=mysqli_real_escape_string($conn,$_GET['id']);
$post_admin_id_query="select * from system where id='$aid'";
$post_admin_id_query_results=$conn->query($post_admin_id_query);
$post_admin_id=$post_admin_id_query_results->fetch_assoc();
$cookies_admin_id=$check_admin_query_results->fetch_assoc();


if($post_admin_id['admin_id'] != $cookies_admin_id['id'])
{
  echo "<script>alert('Sorry You not Had Permession To Do That ')</script>";
  die();

}
if(isset($_POST['submit-student']))
{
  $name=$_POST['student_name'];
  $id=$_POST['student_id'];
  $midterm=$_POST['midterm'];
  $grad=$_POST['grad'];
  $subject=$_POST['subject'];

  if(!empty($name) && !empty($id) && !empty($midterm) && !empty($grad) && !empty($subject))
  {
    $insert_query="UPDATE system SET student_name='$name',student_id='$id',midterm='$midterm',grad='$grad',subject='$subject' WHERE id='$aid'";
    $insert_query_results=$conn->query($insert_query);
    if($insert_query_results === True)
    {
     echo "<script>alert('Changed Succesfully')</script>";
     header("location:website.php");
    }
    else
    {
      echo "<script>alert('An Error Happened')</script>";

    }

  }
  else
  {
    echo "<script>alert('Please Fill All Fields')</script>";
  }
}
$select_query="select * from system where id='$aid'";
$select_query_results=$conn->query($select_query);
$data=$select_query_results->fetch_assoc();







?>







<html>

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/website.css" />
  <style>
    * {
      font-family: 'Lato', sans-serif;
      margin: 0;
      padding: 0;
    }
  </style>


</head>

<body>

  <header>
    <nav class="navbar navbar-expand-sm navbar-light text-white fixed-top">
      <img src="images/acu.png" alt="">
      <button class="navbar-toggler d-lg-none text-white" type="button" data-toggle="collapse"
        data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-white">

          <li class="nav-item dropdown text-white">
            <a class="nav-link dropdown-toggle text-white" href="#" id="dropdownId" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Validation & table</a>
            <div class="dropdown-menu text-white" aria-labelledby="dropdownId">
              <a class="dropdown-item text-dark" href="https://validator.w3.org/" target="_blank">W3C</a>
              <a class="dropdown-item text-dark" href="#table">table</a>
            </div>
          </li>
        </ul>
        <button id="signOut" class="btn btn-outline-danger" href="index.html" target="_blank">SignOut</button>
      </div>

    </nav>
  </header>

  <div class="container border shadow mt-5 p-5">
    <h1>crud system</h1>
    <div class="form-group">
    <form action="change.php?id=<?= $aid?>" method="post" >
      <label>Full Name:</label>
      <input type="text" name="student_name" value="<?=$data['student_name']?>"id="fullName" class="form-control" />
      <div class="alert alert-danger d-none" id="nameAlert" role="alert">
        <strong>empty</strong>
      </div>

    </div>

    <div class="form-group">
      <label>ID:</label>
      <input type="number" value="<?=$data['student_id']?>" name="student_id" id="UserId" class="form-control" />
    </div>
    <div class="alert alert-danger d-none" id="idAlert" role="alert">
      <strong>This number is not valid (ex : 51710251 )</strong>
    </div>



    <div class="form-group">
      <label>Midterm:</label>
      <input type="number" name="midterm" value="<?=$data['midterm']?>" id="midterm" class="form-control" />
    </div>
    <div class="alert alert-danger d-none" id="midAlert" role="alert">
      <strong>This number is not valid (Max : 60 )</strong>
    </div>

    <div class="form-group">
      <label>Grad:</label>
      <input type="number" value="<?=$data['grad']?>" name="grad" id="grad" class="form-control" />
    </div>
    <div class="alert alert-danger d-none" id="gradAlert" role="alert">
      <strong>This number is not valid (Max : 100 )</strong>
    </div>

    <div class="form-group">
      <label>subject:</label>
      <textarea id="sub"  name="subject" class="form-control"><?=$data['subject']?></textarea>
    </div>
    <button class="btn btn-info" name="submit-student" id="addstudent">
      Change
    </button>
    </form>
  </div>

  <input type="text" name="" id="search" class="form-control w-25 mx-auto my-5" placeholder="search By ID..."
    onkeyup="search();" />

  

  <footer class="fixed-bottom">
    <h5 class="text-center bg-dark copyright text-white " aria-hidden="true"> copyright@2020</h5>
  </footer>

  <script src="js/jquery-3.5.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 <!-- <script src="js/Website.js"></script>-->
</body>

</html>