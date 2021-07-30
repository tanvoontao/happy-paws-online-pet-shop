<!DOCTYPE html>
<html lang="en">

<head>
    <title>Happy Paws Pet Shop</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Tan Voon Tao"/>
    <meta name="copyright" content="Tan Voon Tao" />
    <meta name="keywords" content="#"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is Happy Paws Online Pet Shop.">

    <link rel="stylesheet" type="text/css" href="css/style_dekstop.css"/>
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css"/>
    <link rel="stylesheet" type="text/css" href="css/animation.css"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="js/script.js"></script>
</head>

<body>

    <header>
        <nav>
            <p><a href="index.php">HAPPY PAWS</a></p>
        </nav>
    </header>

        

    

    <article>
        <div class="confirm_chat">

            <div class="chatContainer">
                <figure><img src="img/cat_1.jpeg" alt="soya"></figure>
                
                <p>Your order is created! Thank you !!</p>
                <!--<div class="arrow-right"></div>-->
            </div>
            <div class="chatContainer">
                
                
                <p>Remember that pick up your order within 10am to 7pm</p>
                <figure><img src="img/cat_2.jpeg" alt="soya"></figure>
                <!--<div class="arrow-left"></div>-->
            </div>

            <div class="chatContainer">
                <p><label for="pickUpTime">Enter your pick up time: </label><br/><input type="time" id="pickUpTime" /></p>

                <figure><img src="img/cat_3.jpeg" alt="soya"></figure>
                <!--<div class="arrow-left"></div>-->
            </div>

            <div class="chatContainer">
                
                <figure><img src="img/cat_4.jpeg" alt="soya"></figure>
                <p>Click the button to send your order !</p>
                
                <!--<<div class="arrow-right"></div>-->
            </div>
            <a href="#" class="sendBtn" onclick="sendToWhatsApp()">I'm Button</a>
        </div>
        
        
    </article>

    <script src="js/script2.js"></script>
</body>
</html>