<?php
    $servername = "us-cdbr-east-04.cleardb.com";
    $username = "b5987c9f3a39ce";
    $password = "d1f6cdf5";
    $dbname = "heroku_4ef650faeeb566c";

    // host name, database username, password, and database name.
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else{
        // echo 'ok';
    }
?>