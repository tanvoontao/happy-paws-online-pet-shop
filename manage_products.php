<?php
include("include/security.php");
require "setting/settings.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Happy Paws Pet Shop Manage Product Page</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Tan Voon Tao"/>
    <meta name="copyright" content="Tan Voon Tao" />

    <!-- Responsive Img -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is Happy Paws Online Pet Shop Manage Product Page.">


    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/test.css"/>


    <!-- Icon cdn -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Jquery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Identity Platform from GCP -->
    <script src="https://www.gstatic.com/firebasejs/8.7.1/firebase.js"></script>


</head>
<script>
    
    function fetch_select(val){
    $.ajax({
        type: 'post',
        url: 'code2.php',
        data: {
            get_option:val
        },
        success: function (response){
            console.log(document.getElementById("selecte_brand"));
            document.getElementById("selecte_brand").innerHTML = response;
            document.getElementById("selecte_brand_2").innerHTML = response;

        }
    }

    );
}
    
</script>

<body>
    <header class="sidebar">
        <?php include("include/dashboard_navBar.php"); ?>
    </header>
    
    <article>

        <div class="big_content_wrapper">
            <div class="content_wrapper">

                <!--heading and greeding-->
                <div class="heading">
                    <?php include("include/greeding.php"); ?>
                </div>

                <!-- edit brand modal -->
                <div class="edit_category_bg default">
                    


                </div>


                


                <div class="manage_thingy">
                    <h1>Products Management</h1>

                    <!-- notification -->
                    <div class="notification close">
                        <p id="notice">
                            <!--<span><i class='bx bxs-check-circle'></i></span>
                            Category Added Succesfully 📦!-->
                        </p>
                        <p id="notification" onclick="closeaaa()"><i class='bx bx-x'></i></p>
                    </div>



                    <!-- category nav bar -->
                    <ul class="categories_nav_bar">
                        <?php
                            include('setting/category_nav_bar.php');
                        ?>
                    </ul>
                    <hr class="line_break_for_category_nav"/>

                    <div class="product_wrapper">
                        <div class="filter_brands">
                            <p><span><i class='bx bx-filter'></i></span> Filter</p>
                            <p>Brands</p>

                            <ul class="checkbox_filter_brand">
                                <?php
                                    include('setting/brand_nav_checkBox.php');
                                ?>
                            </ul>

                        </div>


                        <!-- Product Table -->
                        <table class="product_table">
                            
                            <tr class="heading_table">
                                <th class="test">Product id</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>


                            <tr>                        
                                <td colspan="4" class="product_modal" onclick="openForm()">
                                        <div class="addOnContainer">
                                            <i class="bx bx-plus"></i>
                                            <span>Add new product</span>
                                        </div>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    Please select category and brands to show the product data.
                                </td>
                            </tr>
                        </table>
                    </div>



                    


                    <!-- Add new brand -->
                    <div class="form_modal_for_add_new_category default">

                        <div class="modal_box">
                            <div class="form_heading">
                                <p>➕ Add new product</p>
                                <p class="closeFormModal"><i class='bx bx-x'></i></p>
                            </div>
                            <hr/>

                            <form method="POST" class="add_category_form" enctype='multipart/form-data'>
                                <div class="form_content">

                                    <div class="inputText">
                                        <input type="text" id="product_name" name="product_name" required>
                                        <span></span>
                                        <label>🥫 Product Name</label><br/>

                                    </div>

                                    <div class="inputText">
                                        <input type="text" id="product_price" name="product_price" placeholder="100.33" required>
                                        <span></span>
                                        <label>💸 Product Price</label><br/>

                                    </div>

                                    <div>
                                        <span class="input_img_heading">Select category</span><br/>
                                        <select name="product_belong_category" onchange="fetch_select(this.value);" required>
                                            <option value=""> - Select Category - </option>
                                            <?php
                                                $query_category = "SELECT * FROM category_table";
                                                $result = mysqli_query($conn, $query_category);
                                                if (mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        echo "<option value='" .$row["category_id"]. "'>" . $row["category_name"] . "</option>";
                                                    }
                                                }

                                            ?>
                                        </select>
                                    </div>

                                        
                                        
                                    <div>
                                        <span class="input_img_heading">Select brand</span><br/>
                                        <select name="product_belong_brand" id="selecte_brand" required>
                                            <option value=""> - Select Brand - </option>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="form_btn">
                                    <button type="reset" class="cancel_btn closeFormModal" >Cancel</button>
                                    <button type="submit" name="add_category" >Add</button>
                                </div>
                                
                            </form>
                        </div>


                    </div>


                    

                    <!-- delete brand modal -->
                    <div class="sureToDelete_bg default">
                        <?php
                            include('include/deleteModal_product.php');
                        ?>

                    </div>
                    
                    
                    

                    
                    



                    

                    

                </div>
            </div>

        </div>
        
    </article>

</body>

<script src="js/script.js"></script>
<script src="js/test.js"></script>
<script>





</script>






<?php
mysqli_close($conn);
?>
</html>

