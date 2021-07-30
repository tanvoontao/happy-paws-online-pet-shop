<!DOCTYPE html>
<html lang="en">

<head>
    <title>Happy Paws Pet Shop Login Page</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Tan Voon Tao"/>
    <meta name="copyright" content="Tan Voon Tao" />

    <!-- Responsive Img -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is Happy Paws Online Pet Shop Login Page.">


    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    


    <!-- Icon cdn -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Jquery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Identity Platform from GCP -->
    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase.js"></script>


</head>



<body>

<!-- green bg -->
<article class="loginPage_bg">
    <section class="circle" style="--i:0"></section>
    <section class="circle" style="--i:1"></section>
    <section class="circle" style="--i:2"></section>

    <!-- Login Section Glassmorphism Card -->
    <div class="loginSectionCard">
        

        <!-- Logo and Map -->
        <div class="logoAndMap">
            <div>
                <img src='img/logo.png' alt='Happy Paws Logo'/>
                <p class='logo_name'>Happy Paws Pet Shop</p>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.3257732009397!2d110.30347791366408!3d1.567251298857087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31fb09ce3177a517%3A0x7c48620c25245eac!2sHappy%20Paws%20Pet%20Shop!5e0!3m2!1szh-CN!2smy!4v1626851750015!5m2!1szh-CN!2smy"  style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

    
        <!-- Login Form -->
        <form id="loginForm">
            <h1>Admin Sign In</h1>

            <!-- Email -->
            <p>
                <input type="email" name="email" id="email" required/>
                <span></span>
                <label>📧 Email</label>
            </p>
            
            <!-- Password -->
            <p>
                <input type="password" name="password" id="password" required/>
                <span></span>
                <label>🔑 Password</label>
            </p>

            <span id="error_txt"></span>
            <div class="signIn_btn_wrapper">
            <input type="submit" value="Sign In" name="sign_in_btn"/>
            <span id="sign_In_loading_spinner"></span>
            </div>
            

        </form>

    </div>    

</article>

<!-- JS -->
<script src="js/login.js"></script>

</body>

</html>
