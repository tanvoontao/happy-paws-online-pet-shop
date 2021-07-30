<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting To login Page
        header("Location: login.php");
    }
?>