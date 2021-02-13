<?php
require("db.php");
if(isset($_COOKIE['user_session']))
{
  $cook=$_COOKIE['user_session'];
  $check_student_query="select * from students Where session_id='$cook'";
  $check_student_query_results=$conn->query($check_student_query);
  $student_query=$check_student_query_results->fetch_assoc();
  $student_id=$student_query['id'];

  if(!$check_student_query_results->num_rows > 0)
  {
    header("location:index.php");
  }
}
else
{
  header("location:index.php");
}
$view_student_query="select * from system where student_id='$student_id'";
$view_student_query_results=$conn->query($view_student_query);






?>









<html>
 
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/website.css"/>

    <style>
      
     *{
    font-family: 'Lato', sans-serif;
    margin: 0;
    padding: 0;
}

body{
      background-color: rgba(23, 162, 184, 0.7);
    }
    .notP{
      cursor: text!important; 
    }
      
      </style>


 
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-sm text-white fixed-top" style="background-color:  rgba(52, 58, 64, 0.95)">
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
         <a href="logout.php"> <button id="signOut" class="btn btn-outline-danger"  >SignOut</button></a>
        </div>
        
      </nav>
    </header>

  



    <table class="w-75 table-striped text-center" id="table">
      <thead>
        <th>ID</th>
        <th>Full Name</th>
        <th>midterm</th>
        <th>Grad</th>
        <th>subject</th>
      </thead>
      <tbody>
        <?php while($student=$view_student_query_results->fetch_assoc()){?>
        <tr>
          <td><?= $student['student_id']?></td>
          <td><?= $student['student_name']?></td>
          <td><?= $student['midterm']?></td>
          <td><?= $student['grad']?></td>
          <td class="btn btn-danger mt-2 notP"><?= $student['subject']?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <footer class="fixed-bottom">
      <h5 class="text-center bg-dark copyright text-white "  aria-hidden="true"> copyright@2020</h5>
    </footer>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/stuWebsite.js"></script>
  </body>
</html>
