<?php

function OpenCon() {
    global $conn;
    $host="dbhost.cs.man.ac.uk";
    $user="b09217es";
    $password="y5isthebest";
    $db=array("2019_comp10120_y5");

    $conn = mysqli_connect($host, $user, $password,$db[0]) or die(mysqli_error($conn));

 }

function CloseCon($conn){
    mysqli_close($conn);
 }
?>