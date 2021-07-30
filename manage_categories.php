<?php
include("include/security.php");
require "setting/settings.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Happy Paws Pet Shop Manage Category Page</title>
    <meta charset="utf-8"/>
    <meta name="author" content="Tan Voon Tao"/>
    <meta name="copyright" content="Tan Voon Tao" />

    <!-- Responsive Img -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is Happy Paws Online Pet Shop Manage Category Page.">


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
    

    
</script>

<body>
    <header class="sidebar">
        <?php include("include/dashboard_navBar.php"); ?>
    </header>
    
    <article>

        <div class="big_content_wrapper">
            <div class="content_wrapper">
                <div class="heading">
                    <?php include("include/greeding.php"); ?>
                    
                </div>


                <div class="edit_category_bg default">
                    <?php
                        include('edit_category.php');
                    ?>


                </div>


                <div class="manage_thingy">
                    <h1>Category Management</h1>

                    <!-- notification -->
                    <div class="notification close">
                        <p id="notice">
                            <!--<span><i class='bx bxs-check-circle'></i></span>
                            Category Added Succesfully 📦!-->
                        </p>
                        <p id="notification" onclick="closeaaa()"><i class='bx bx-x'></i></p>
                    </div>

                    <ul id='categories_container'>
                        <?php
                            include('setting/updateCategory.php');
                        ?>
                    </ul>
                    



                    <div class="form_modal_for_add_new_category default">
                        <div class="modal_box">
                            <div class="form_heading">
                                <p>➕ Add new category</p>
                                <p class="closeFormModal"><i class='bx bx-x'></i></p>
                            </div>
                            <hr/>


                            <form action="code2.php" method="POST" class="add_category_form" enctype='multipart/form-data'>
                                <div class="form_content">

                                    <div class="inputText">
                                        <input type="text" id="category_name" name="category_name" required>
                                        <span></span>
                                        <label>📦 Category Name</label><br/>

                                    </div>

                                    <div class="img_input_container">
                                        <div class="wrapper_input_file">
                                            <span class="input_img_heading">Category Image</span>
                                            <div class="drag-area">
                                                
                                                <div class="icon"><i class='bx bx-cloud-upload'></i></div>
                                                <p class="dragText">Drag & Drop or Click to Upload Image File</p>
                                                <input type="file" id="category_img" name="category_img"  class="drop-zone__input" required>

                                            </div>
                                        </div>
                                        
                                        <div class="wrapper_input_file">
                                            <span class="input_img_heading">Category Icon Image</span>

                                            <div class="drag-area">
                                                
                                                <div class="icon"><i class='bx bx-cloud-upload'></i></div>
                                                <p class="dragText">Drag & Drop or Click to Upload Image File</p>
                                                <input type="file" id="category_icon_img" name="category_icon_img"  class="drop-zone__input" required>

                                            </div>

                                            
                                        </div>
                                    </div>
                                    
                                    

                                    

                                    
                                </div>

                                <div class="form_btn">
                                    <button type="reset" class="cancel_btn closeFormModal" >Cancel</button>
                                    <button type="submit" name="add_category" >Add</button>
                                </div>
                                
                            </form>
                        </div>


                    </div>

                    <div class="sureToDelete_bg default">
                        <?php
                            include('include/deletemodal.php');
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

