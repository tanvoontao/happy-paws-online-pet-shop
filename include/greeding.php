<?php
    $greeding = "";

    function getTimeAndGreding(){
        date_default_timezone_set("Asia/Kuching");
        $hour = date("h");
        $am_or_pm = date("a");
        
        if (($hour > 4 && $hour < 12) && ($am_or_pm == "am")){
            return "Good Morning";
        }elseif  ( ($hour > 0 && $hour < 5) && ($am_or_pm == "pm") ){
            return "Good Afternoon";
        }elseif (($hour == 12) && ($am_or_pm == "pm") ){
            return "Good Afternoon";
        }
        else{
            return "Good Evening";
        }
    }

    $greeding = getTimeAndGreding();
    echo "<div>";
    echo "<div>";
    echo "<p>$greeding 👋, ".$_SESSION['userEmail']."</p>";
    echo '<p>' . date("l d M, Y", strtotime("now")) . '</p></div>';
    echo "<p><a href='logout.php' id='logout_btn'>🚪 Logout<a/></p>";
    echo "</div>";
    echo "<hr/>";
?>