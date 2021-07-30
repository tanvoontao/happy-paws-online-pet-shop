<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "happy_paws_online_dashboard_db";

    // host name, database username, password, and database name.
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else{
        // echo 'ok';
    }
?>