<!DOCTYPE html>
<html lang="en">

<head>
    <title>Happy Paws Pet Shop</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Tan Voon Tao"/>
    <meta name="copyright" content="Tan Voon Tao" />
    <meta name="keywords" content="Happy Paws"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is Happy Paws Online Pet Shop.">

    <link rel="stylesheet" type="text/css" href="css/style_dekstop.css"/>
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css"/>
    <link rel="stylesheet" type="text/css" href="css/animation.css"/>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

    <script src="js/script2.js"></script>
</head>

<body>

    <header>
        <nav>
            <p><a href="index.php">HAPPY PAWS</a></p>
        </nav>
    </header>

        

    

    <article>
        <span class="GoBackBtn" onclick="goBack()"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
        <h1>Cart Product</h1>
        <div class="overlay_bg default">
            <div class="popUpAlertBox">
                <div class="popUpHeading">
                    <p>Quantity can't be zero</p>
                    <p onclick="closeAlertBox()"><span class="redWord"><i class="fa fa-times" aria-hidden="true"></i></span></p>
                </div>
                <hr/>
                <div class="popUpText">
                    <img src="img/alert.gif" alt="alert"/>
                    <p>Your quantity can't be 0.</p>
                </div>
                <button class="ok" onclick="closeAlertBox()">OK</button>
            </div>
        </div>
        <ul class="cart_form">
            <script>createCart()</script>
        </ul>
        
        <hr class="lineBreak"/>

        <p class="total">
            <span>Total :</span>
            <span id="showTotal"></span>
        </p>
    
        <a href="confirm.php" class="confirm_btn">Confirm Order</a>


    </article>

    <script src="js/script3.js"></script>
</body>
</html>