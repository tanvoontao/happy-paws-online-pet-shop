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
    <meta name="keywords" content="Happy Paws, pet shop, kuching, online pet shop, dry food, wet food, cat litter, accessories"/>

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

        <h1>Categories</h1>
        <!--Starting page-->
        <div class="startingPage">
            <figure>
                <img src="img/soya.png" alt="soya"/>
            </figure>
            <p>Meow~</p>
            <p>Welcome to</p>
            <p>HAPPY PAWS PET SHOP !!</p>
            
            <div class="pulse">
                <button class="start_btn" onclick="slideFunction()">START</button>
           </div>
        </div>

        <!--All Category-->
        <ul class="grid_container_forCategory">
            <!-- Create category -->
            <?php
                $category_query = "SELECT * FROM category_table";
                $category_query_run = mysqli_query($conn, $category_query);

                if (mysqli_num_rows($category_query_run) > 0){
                    while($row = mysqli_fetch_assoc($category_query_run)){
                        echo '
                        <li class="category_box">
                            <a href="category.php?category_id='.$row['category_id'].'">
                                <div style="background-image: linear-gradient(to top, #006d77 -50%, transparent),url(upload/'.$row['category_img'].')"></div>
                                <p>'.$row['category_name'].'</p>
                            </a>
                        </li>
                        ';
                    }
                }
            ?>
        </ul>

        <div class="clarify">
            <p>This site <span class="redWord">only</span> have HOT products</p>
            <p>To purchase other product,</p>
            <p>you may contact staff <span class="redWord">after submit</span>!</p>
            <p>Thank you!</p>
        </div>

    </article>

</body>
<?php
mysqli_close($conn);
?>
</html>