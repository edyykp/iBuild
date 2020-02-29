<?php

//get user_id once user is logged in
$userid = $_SESSION['user_id'];

//connection to the database
include 'connect_db.php';
OpenCon();

//Need to get from database for architects:
//Name, Description, Location, mail
$sql = "SELECT * FROM Users WHERE user_id = '$userid'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

//List of projects with: Rating, description, tags
$sql2 = "SELECT * FROM Projects WHERE user_id = '$userid'";
$result2 = mysqli_query($conn, $sql2);

//Find how many projects under userid
//Create a textbox for each project
//Use the project ID to fill the textbox for each project

function createTags($projectid) {
  global $conn;
  $sql3 = "SELECT * FROM Tags WHERE project_id = '$projectid'";
  $result3 = mysqli_query($conn, $sql3);
}
//Find how many tags under projectid
//Create a tagbox for each tags
//Use the tag ID to fill the tagname for each tag
?>
