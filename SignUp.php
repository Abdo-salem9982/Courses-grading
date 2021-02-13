<?php
require("db.php");
if (isset($_POST['reg-submit']))
{
  $type=$_POST['employees'];
  if( $type === "student" )
  {
    $id= mysqli_real_escape_string($conn,$_POST['reg-id']);
    $email= mysqli_real_escape_string($conn,$_POST["email"]);
    $password=md5(mysqli_real_escape_string($conn,$_POST['reg-password'])); 
    if( !empty($id) && !empty($email) && !empty($password) )
    {
      $id_check_query="select id from students where id='$id'";
      $id_check_query_results=$conn->query($id_check_query);
      $email_check_query="select email from students where email='$email'";
      $email_check_query_results=$conn->query($email_check_query);
      if($id_check_query_results->num_rows > 0 )
      {
        echo "<script>alert('Id Already Exist')</script>";
      }
      elseif($email_check_query_results->num_rows > 0)
      {
        echo "<script>alert('Email Already Exist')</script>";
      }
      elseif(strlen($id)>11 )
      {
        echo "<script>alert('Sorry Id length must be less than 12')</script>";
      }
      else
      {
        $student_query="insert into students (id,email,password) values('$id' , '$email' , '$password')";
        $student_query_result=$conn->query($student_query);
        if($student_query_result === TRUE)
        {
          echo "<script>alert('Student Registration Success')</script>";
          header("location:index.php");
        }
        else
        {
          echo "<script>alert('An Error Happened ') </script>";
        }
      }
    } 
    else
    {
      echo "<script>alert('please fill all fields')</script>";
    }  
  }
  if( $type === "admin" )
  {
    $email= mysqli_real_escape_string($conn,$_POST["email"]);
    $password=md5(mysqli_real_escape_string($conn,$_POST['reg-password'])); 
    if(!empty($email) && !empty($password) )
    {
      $email_check_query="select email from admins where email='$email'";
      $email_check_query_results=$conn->query($email_check_query);
      if($email_check_query_results->num_rows > 0)
      {
        echo "<script>alert('Email Already Exist')</script>";
      }
      else
      {
        $admin_query="insert into admins (email,password) values( '$email' , '$password')";
        $admin_query_result=$conn->query($admin_query);
        if($admin_query_result === TRUE)
        {
          echo "<script>alert('Admin Registration Success')</script>";
          header("location:index.php");
        }
        else
        {
          echo "<script>alert('An Error Happened ') </script>";
        }
      }
    } 
    else
    {
      echo "<script>alert('please fill all fields')</script>";
    }  
  }



 
}













?>









<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
      body {
        font-family: 'Lato', sans-serif;
    background-color: rgba(136, 131, 131, 0.123);
    background-blend-mode:multiply;
    font-weight: bolder;
      }
      
      </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm text-white fixed-top"  style="background-color:  rgba(52, 58, 64, 0.95)">
          <img src="images/acu.png" alt="">
          <button class="navbar-toggler d-lg-none text-white" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
              aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-white">
              
              <li class="nav-item dropdown text-white">
                <a class="nav-link dropdown-toggle text-white" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Validation</a>
                <div class="dropdown-menu text-white" aria-labelledby="dropdownId">
                  <a class="dropdown-item text-dark" href="https://validator.w3.org/" target="_blank">W3C</a>
                </div>
              </li>
            </ul>
          </div>
          
        </nav>
      </header>


    <div class="container">
        <div class="dflex">
            <div id="signUp" class="text-center">
                <h1 id="signUpTitle" class="py-3">Create Account</h1>
                <form action="SignUp.php" method="POST">

                <input type="radio" id="radAdmin" name="employees" value="admin" checked>
                <label  class="mr-3">Admin</label>


                <input type="radio" id="radStudent" name="employees" value="student">
                <label >student</label>      


                <input type="email" name="email" id="signUpEmail" placeholder="Email" class="form-control w-75">
                
                <div class="alert alert-danger d-none alertEditUp" id="emailAlert" role="alert">
                    <strong>Email is not Valide ( ex: Acu@gmail.com )</strong>
                  </div>
                <input type="text" name="reg-id" id="stuId" placeholder="ID" class="form-control w-75 d-none">
                <div class="alert alert-danger d-none alertEditUp" id="idAlert" role="alert">
                    <strong>ID is not Valide ( ex: 51710251 )</strong>
                  </div>
                <input type="password" name="reg-password" id="signUpPass" placeholder="Password" class="form-control w-75">
                <br>
                <p id="success">Success</p>
                <button class="btn btn-outline-danger button-edit"  name="reg-submit" id="signUpButton">Sign Up</button>
                <p class="mt-1">You have an account? <a id="signInLink" href="index.php">Login</a> </p>
                </form>   
            </div>
        </div>
              
    </div>

    <footer class="fixed-bottom">
      <h5 class="text-center bg-dark copyright text-white "  aria-hidden="true"> copyright@2020</h5>
    </footer>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/javaSignUp.js"></script>

    
</body>

</html>