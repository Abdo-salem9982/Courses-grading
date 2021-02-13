<?php
require("db.php");

if(isset($_COOKIE['user_session']))
{
  $cook=$_COOKIE['user_session'];
  $check_admin_query="select * from admins Where session_id='$cook'";
  $check_admin_query_results=$conn->query($check_admin_query);
  $admin_query=$check_admin_query_results->fetch_assoc();
  $admin_id=$admin_query['id'];

  if(!$check_admin_query_results->num_rows > 0)
  {
    header("location:index.php");
  }
}
else
{
  header("location:index.php");
}
if(isset($_POST['submit-student']))
{
  $name=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['student_name']));
  $id=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['student_id']));
  $midterm=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['midterm']));
  $grad=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['grad']));
  $subject=htmlspecialchars(mysqli_real_escape_string($conn,$_POST['subject']));


  if(!empty($name) && !empty($id) && !empty($midterm) && !empty($grad) && !empty($subject))
  {
    if(is_numeric($id) && strlen($id) < 12)
    {
      $insert_query="insert into system(student_name,student_id,midterm,grad,subject,admin_id) values('$name','$id','$midterm','$grad','$subject','$admin_id') ";
      $insert_query_results=$conn->query($insert_query);
      if($insert_query_results === True)
      {
      echo "<script>alert('Added Succesfully')</script>";

      }
      else
      {
        echo "<script>alert('An Error Happened')</script>";

      }

  
    }
    else
    {
      echo "<script>alert('Please Enter Right Id')</script>";

    }
    
  }
  else
  {
    echo "<script>alert('Please Fill All Fields')</script>";
  }
}
$select_query="select * from system where admin_id='$admin_id' ";
$select_query_results=$conn->query($select_query);








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
    body{
      background-color: rgba(23, 162, 184, 0.7);
    }
    #peter{
      background-color: white;
    }
  </style>


</head>

<body>

  <header>
    <nav class="navbar navbar-expand-sm fixed-top "  style="background-color:  rgba(52, 58, 64, 0.95)">
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
       <a href="logout.php"> <button id="signOut" class="btn btn-outline-danger"  >SignOut</button></a>
      </div>

    </nav>
  </header>
 

  <div class="container border shadow mt-5 p-5" id='peter'>
    <h1>crud system</h1>
    <div class="form-group">
    <form action="website.php" method="post" >
      <label>Full Name:</label>
      <input type="text" name="student_name" id="fullName" class="form-control" />
      <div class="alert alert-danger d-none" id="nameAlert" role="alert">
        <strong>empty</strong>
      </div>

    </div>

    <div class="form-group">
      <label>ID:</label>
      <input type="number" name="student_id" id="UserId" class="form-control" />
    </div>
    <div class="alert alert-danger d-none" id="idAlert" role="alert">
      <strong>This number is not valid (ex : 51710251 )</strong>
    </div>



    <div class="form-group">
      <label>Midterm:</label>
      <input type="number" name="midterm" id="midterm" class="form-control" />
    </div>
    <div class="alert alert-danger d-none" id="midAlert" role="alert">
      <strong>This number is not valid (Max : 60 )</strong>
    </div>

    <div class="form-group">
      <label>Grad:</label>
      <input type="number" name="grad" id="grad" class="form-control" />
    </div>
    <div class="alert alert-danger d-none" id="gradAlert" role="alert">
      <strong>This number is not valid (Max : 100 )</strong>
    </div>

    <div class="form-group">
      <label>subject:</label>
      <textarea id="sub"  name="subject" class="form-control"></textarea>
    </div>
    <button class="btn btn-info"  name="submit-student" id="addstudent">
      add student
    </button>
    </form>
  </div>

  

  <table class=" container border shadow p-5 w-75 table-striped text-center bg-white "  id="table">
    <thead>
      <th  class="p-3">ID</th>
      <th  class="p-3">Full Name</th>
      <th  class="p-3">midterm</th>
      <th  class="p-3">Grad</th>
      <th  class="p-3">subject</th>
      <th  class="p-3">delete</th>
      <th  class="p-3">update</th>
    </thead>
    <tbody>
    <?php while($data=$select_query_results->fetch_assoc()){?>
    <tr>
      <td class="p-3"><?= $data['student_id']?></td>
      <td  class="p-3"><?= $data['student_name']?></td>
      <td  class="p-3"><?= $data['midterm']?></td>
      <td  class="p-3"><?= $data['grad']?></td>
      <td  class="p-3"><?= $data['subject']?></td>
      <td  class="p-3"><a class="btn btn-danger" href="delete.php?id=<?=$data['id'] ?>">delete</a></td>
      <td  class="p-3"><a class="btn btn-success" href="change.php?id=<?=$data['id'] ?>">update</a></td>
    </tr>
    <?php }?>
    </tbody>
  </table>


  <footer class="fixed-bottom">
    <h5 class="text-center bg-dark copyright text-white " aria-hidden="true"> copyright@2020</h5>
  </footer>

  <script src="js/jquery-3.5.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 <!-- <script src="js/Website.js"></script>-->
</body>

</html>