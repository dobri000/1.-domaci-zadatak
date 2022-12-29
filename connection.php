<?php

    $mysql_server = "localhost";
    $mysql_user = "root";
    $mysql_password = "";
    $mysql_db = "rezultatiutakmica";

    $conn = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");

?>