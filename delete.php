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
$id=mysqli_real_escape_string($conn,$_GET['id']);
$post_admin_id_query="select * from system where id='$id'";
$post_admin_id_query_results=$conn->query($post_admin_id_query);
$post_admin_id=$post_admin_id_query_results->fetch_assoc();
$cookies_admin_id=$check_admin_query_results->fetch_assoc();


if($post_admin_id['admin_id'] != $cookies_admin_id['id'])
{
  echo "<script>alert('Sorry You not Had Permession To Do That ')</script>";
  die();

}
$delete_query="delete from system where id='$id'";
$delete_query_results=$conn->query($delete_query);
header("location:website.php");









?>