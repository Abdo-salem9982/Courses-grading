<?php
require("db.php");

if(isset($_COOKIE['user_session']))
{
  $cooks=$_COOKIE['user_session'];
  $check_ses="select * from admins where session_id='$cooks'";
  $check_ses_results=$conn->query($check_ses);
  if($check_ses_results->num_rows > 0)
  {
    header("location:website.php");
  }
}
if(isset($_POST['log-submit']))
{
  if($_POST['employees'] == "admin")
  {
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=md5(mysqli_real_escape_string($conn,$_POST['password']));
    if(!empty($email) && !empty($password))
    {
      $check_user_query="select email from admins where email='$email' and password='$password'";
      $check_user_query_results=$conn->query($check_user_query);
      if($check_user_query_results->num_rows > 0)
      {
        $session_id=md5(rand(1000000000000,9999999999999));
        $insert_session="update admins set session_id='$session_id' where email='$email' ";
        $insert_session_res=$conn->query($insert_session);
        setcookie('user_session',$session_id); 
        header("location:website.php");
      }
      else
      {
        echo "<script>alert('Wrong Email Or Password')</script>";    
      }
    }
    else
    {
      echo "<script>alert('Please Fill All Fields')</script>";
    }
  }
  if($_POST['employees'] == "student")
  {
    $login_id=mysqli_real_escape_string($conn,$_POST['reg-id']);
    $password=md5(mysqli_real_escape_string($conn,$_POST['password']));
    if(!empty($login_id) && !empty($password))
    {
      $check_user_query="select id from students where id='$login_id' and password='$password'";
      $check_user_query_results=$conn->query($check_user_query);
      if($check_user_query_results->num_rows > 0)
      {
        $session_id=md5(rand(1000000000000,9999999999999));
        $insert_session="update students set session_id='$session_id' where id='$login_id' ";
        $insert_session_res=$conn->query($insert_session);
        setcookie('user_session',$session_id); 
        header("location:stuWebsite.php");
      }
      else
      {
        echo "<script>alert('Wrong id Or Password')</script>";    
      }
    }
    else
    {
      echo "<script>alert('Please Fill All Fields')</script>";
    }
  }
}





?>










<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <nav class="navbar navbar-expand-sm  text-white fixed-top"  style="background-color:  rgba(52, 58, 64, 0.95)">
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
            <div id="signUp" class="text-center shadow-lg">
              
                <h1 id="signUpTitle" class="py-3">Login</h1>
                <form action="index.php" method="post"> 
                <input type="radio" id="radAdmin" name="employees" value="admin" checked>
                <label  class="mr-3">Admin</label>
                <input type="radio" id="radStudent" name="employees" value="student">
                <label >student</label> 
                <input type="email" name="email" id="signInEmail" placeholder="Email" class="form-control w-75 " >
                
                <input type="text" name="reg-id" id="stuId" placeholder="ID" class="form-control w-75 d-none">

                <div class="alertEdit w-75 d-none bg-danger" role="alert" id="emailAlert">
                    please Enter Your Email !
                  </div>
                <input type="password" name="password" id="signInPass" placeholder="Password" class="form-control w-75 ">
                <div class="alertEdit bg-danger w-75 d-none  " role="alert" id="passAlert">
                    Please enter Your Password
                  </div>
                <br>
                <p id="success">Success</p>

                <button class="btn-primary button-edit" name="log-submit" id="signInButton">Sign In</button>
                </form>
              <a href="SignUp.php">  <button class="btn btn-outline-danger mt-1 button-edit" id="signUpButton">Sign Up</button></a>
                
            </div>
        </div>

    </div>

    <footer class="fixed-bottom">
      <h5 class="text-center bg-dark copyright text-white "  aria-hidden="true"> copyright@2020</h5>
    </footer>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/javaSignIn.js"></script>
    <script src="js/javaSignUp.js"></script>

  
</body>

</html>