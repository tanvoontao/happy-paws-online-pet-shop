<?php
require "setting/settings.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Happy Paws Pet Shop</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Tan Voon Tao"/>
    <meta name="copyright" content="Tan Voon Tao" />
    <meta name="keywords" content="Happy Paws, category, dry food, wet food, cat litter, accessories"/>

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
        <ul class="cartItemsCounter">
            <script>updateCartCounter()</script>
        </ul>
        <p class="cart">
            <a href="cart.php">🛒</a>
        </p>
    </header>
    

    <article>
        <h1>Categories</h1>

        <!--CATEGORY NAV BAR-->
        <ul class="nav_bar_category">
            <?php
                $category_nav_query = "SELECT * FROM category_table";
                $category_nav_query_run = mysqli_query($conn, $category_nav_query);

                if (mysqli_num_rows($category_nav_query_run) > 0){
                    while($row = mysqli_fetch_assoc($category_nav_query_run)){
                        echo '
                        <li id="';if ((isset($_GET['category_id'])) && ($_GET['category_id'] == $row['category_id'])){echo "active";}; echo'">
                            <a href="category.php?category_id='.$row['category_id'].'">
                                <figure>
                                    <img src="upload/'.$row['category_icon_img'].'" alt="'.$row['category_icon_img'].'"/>
                                </figure>
                                <p>'.$row['category_name'].'</p>
                            </a>
                        </li>
                        ';
                    }
                }
            
            ?>
        </ul>

        <div class="overlay_bg default">
            <div class="popUpAlertBox">
                <div class="popUpHeading">
                    <p>Select Variation</p>
                    <p onclick="closeAlertBox()"><span class="redWord"><i class="fa fa-times" aria-hidden="true"></i></span></p>
                </div>
                <hr/>
                <div class="popUpText">
                    <img src="img/alert.gif" alt="alert"/>
                    <p>You need to select variation before add to cart</p>
                </div>
                <button class="ok" onclick="closeAlertBox()">OK</button>
            </div>
        </div>
        
        
        <!--DRY FOOD PRODUCT LIST-->
        <ul class="grid_container">
            <?php
                $current_cat_id = $_GET['category_id'];
                $brand_query = "SELECT * FROM brand_table WHERE category_id = '$current_cat_id'";
                $brand_query_run = mysqli_query($conn, $brand_query);

                
                $delay = 0.00;
                if (mysqli_num_rows($brand_query_run) > 0){
                    while($row1 = mysqli_fetch_assoc($brand_query_run)){
                        echo '
                        <li class="product_card" style="animation-delay: '.$delay.'s;">
                            <img src="upload/'.$row1['brand_img'].'" alt="'.$row1['brand_img'].'"/>
                            <div class="item_detail">
                                <p>'.$row1['brand_name'].'</p>
                                <div>
                                    <select name="#" id="#" title="#">
                                    
                                    
                                        <option value=" ">- select variation -</option>';
                                        
                                        $temp_brand_id = $row1['brand_id'];
                                        $product_query = "SELECT * FROM product_table WHERE category_id = '$current_cat_id' AND brand_id='$temp_brand_id'";
                                        $product_query_run = mysqli_query($conn, $product_query);
                                        
                                        if (mysqli_num_rows($product_query_run) > 0){
                                            while($row2 = mysqli_fetch_assoc($product_query_run)){
                                                echo '
                                                <option value="'.$row2['product_name'].','.$row2['product_price'].'">'.$row2['product_name'].' - RM '.$row2['product_price'].'</option>
                                                ';
                                            }
                                        }
                                    echo '
                                    </select>

                                    <button class="addToCart_btn">
                                        <p class="addTocart">🛒</p>
                                        <span class="addTocart_Text">Add to cart</span>
                                    </button>
                                </div>
                            </div>
                        </li>
                        ';
                        $delay += 0.05;
                    }
                }
            
            ?>
        </ul>
        
        


    </article>
    <footer>
            <p>Follow our social media.</p>
            <ul class="sci">
                <li><a href="https://www.facebook.com/wei.then.5" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="http://www.wasap.my/+601136368586" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
            </ul>
        
    </footer>


    <script src="js/script3.js"></script>
</body>
<?php
mysqli_close($conn);
?>
</html>