<?php

function select_id($parameter) {
    include_once "connect_db.php";
    OpenCon();
    $sql = "SELECT user_id from Users where email = $parameter";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    CloseCon();
    return $row;
}
?>