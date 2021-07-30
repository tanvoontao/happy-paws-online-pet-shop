<?php
include("include/security.php");
require "setting/settings.php";


    // add new category to database
    if (isset($_POST["category_name"])){
        $category_name = $_POST["category_name"];
        $category_img = $_FILES["category_img"]['name'];
        $category_icon_img = $_FILES["category_icon_img"]['name'];
        
        //print_r(array(True, "Category Added Succesfully 📦!")) ;
        
        if ( (file_exists("upload/".$_FILES["category_img"]['name'])) || (file_exists("upload/".$_FILES["category_icon_img"]['name'])) ) {

            // if img existed
            echo "<span><i class='bx bxs-error'></i></span>Error: File existed! Please change the file name or try another image";
        }else{
            $insert_category_query = "INSERT into category_table (category_name, category_img, category_icon_img)
                                    VALUES ('$category_name', '$category_img', '$category_icon_img')";
            $insert_category_query_run = mysqli_query($conn, $insert_category_query);
            if ($insert_category_query_run) {

                // the move_uploaded_file() function moves an uploaded file to a new destination.
                // This function only works on files uploaded via PHP's HTTP POST upload mechanism.
                // If the destination file already exists, it will be overwritten.
                // move_uploaded_file(file, dest) -- parameter

                move_uploaded_file($_FILES["category_img"]['tmp_name'], "upload/".$_FILES["category_img"]['name']);
                move_uploaded_file($_FILES["category_icon_img"]['tmp_name'], "upload/".$_FILES["category_icon_img"]['name']);
                //echo array(True, "Category Added Succesfully 📦!");
                echo "<span><i class='bx bxs-check-circle'></i></span>Category Added Succesfully 📦!";
            }else{
                echo "Error: Something wrong";
            }
        }
        
        
        
    }

    // delete category
    if (isset($_POST["delete_category_id"])){
        $category_id =  $_POST['delete_category_id'];
        $delete_category_query = "SELECT * FROM CATEGORY_TABLE WHERE category_id='$category_id'";
        $delete_category_query_run = mysqli_query($conn, $delete_category_query);

        foreach($delete_category_query_run as $rows){

            if (($img_path = "upload/".$rows['category_img']) && ($img_path_2 = "upload/".$rows['category_icon_img'])){
            
                $brand_query = "UPDATE brand_table SET category_id=NULL WHERE category_id='$category_id'";
                $brand_query_run = mysqli_query($conn, $brand_query);

                $product_query = "UPDATE product_table SET category_id=NULL WHERE category_id='$category_id'";
                $product_query_run = mysqli_query($conn, $product_query);

                $query = "DELETE FROM category_table WHERE category_id ='$category_id'";
                $query_run = mysqli_query($conn, $query);

                if ($query_run){
                    if ($brand_query_run){
                        if ($product_query_run){
                            unlink($img_path);
                            unlink($img_path_2);
                            //header("location:manage_categories.php?id=Delete successfully. Please edit the brands or products which belongs to this category."); // redirects to all records page
                            echo "<span><i class='bx bxs-error'></i></span> Delete successfully. Please edit the brands or products which belongs to this category.";
                        }
                    }
                    
                }else{
                    echo "Error: Not success";
                }
            }
            
        }
    }
    
    // Edit save category
    if (isset($_POST["edit_category_id"])){
        $category_id = $_POST['edit_category_id'];
        $category_name = $_POST["new_category_name"];
        $category_img = $_FILES["new_category_img"]['name'];
        $category_icon_img = $_FILES["new_category_icon_img"]['name'];

        $category_query = "SELECT * FROM category_table WHERE category_id = '$category_id'";
        $category_query_run = mysqli_query($conn, $category_query);


        foreach ($category_query_run as $category_row){
            if (($category_img == NULL) && ($category_icon_img == NULL)){
                $image_data = $category_row['category_img'];
                $image_data_2 = $category_row['category_icon_img'];
            }else{
                if (($category_img != NULL) && ($category_icon_img != NULL)){
                    if (($img_path = "upload/".$category_row['category_img']) && ($img_path_2 = "upload/".$category_row['category_icon_img'])){
                        unlink($img_path);
                        unlink($img_path_2);

                        $image_data = $category_img; // new img
                        $image_data_2 = $category_icon_img;// new icon

                    }
                }
            }

            if (($category_img == NULL) && ($category_icon_img != NULL)){
                // existed img and new icon
                $image_data = $category_row['category_img']; // existed
                $image_data_2 = $category_icon_img; // new icon
                // unlink new icon
                if ($img_path_2 = "upload/".$category_row['category_icon_img']){
                    $image_data_2 = $category_icon_img;
                }

            }

            if (($category_img != NULL) && ($category_icon_img == NULL)){
                // new img and existed icon
                $image_data = $category_img; // new img
                $image_data_2 = $category_row['category_icon_img']; // existed icon
                
                // unlink new img
                if ($img_path = "upload/".$category_row['category_img']){
                    unlink($img_path);
                    $image_data = $category_img;
                }

            }
            
        }


        $query = "UPDATE category_table 

                SET category_name='$category_name', 
                    category_img='$image_data', 
                    category_icon_img='$image_data_2' 

                WHERE category_id='$category_id'";

        
        $query_run = mysqli_query($conn, $query);
        if ($query_run){
            if (($category_img == NULL) && ($category_icon_img == NULL)){
                // echo "update existing img";
                echo "<span><i class='bx bxs-check-circle'></i></span>Category Save Changed 📦!";
            }
            else{
                move_uploaded_file($_FILES["new_category_img"]['tmp_name'], "upload/".$image_data);
                move_uploaded_file($_FILES["new_category_icon_img"]['tmp_name'], "upload/".$image_data_2);
                echo "<span><i class='bx bxs-check-circle'></i></span>Category Save Changed 📦!";
            }
            
        }
        else{
            echo "Error: Not success";
        }
    }





    // add new brand to database
    if (isset($_POST['brand_name'])){
        $brand_name = $_POST["brand_name"];
        $brand_belong_category = $_POST["brand_belong_category"];
        $brand_img = $_FILES["brand_img"]['name'];
        
        if ( (file_exists("upload/".$_FILES["brand_img"]['name']) ) ){
            
            echo "<span><i class='bx bxs-error'></i></span>Error: File existed! Please change the file name or try another image";
            //echo "existed";
        }
        else{
            $query =   "INSERT into brand_table (brand_name, brand_img, category_id)
            VALUES ('$brand_name', '$brand_img', '$brand_belong_category')";
            $query_run = mysqli_query($conn, $query);
            if ($query_run){
    
                // the move_uploaded_file() function moves an uploaded file to a new destination.
                // This function only works on files uploaded via PHP's HTTP POST upload mechanism.
                // If the destination file already exists, it will be overwritten.
                // move_uploaded_file(file, dest) -- parameter
    
                move_uploaded_file($_FILES["brand_img"]['tmp_name'], "upload/".$_FILES["brand_img"]['name']);
                echo "<span><i class='bx bxs-check-circle'></i></span>Brand Added Succesfully 🏷️!";
                //echo "ok";
    
            }
            else{
                echo "Error: Something wrong";
            }
            
        }
    }


    // delete brand 
    if (isset($_POST['delete_brand_id'])){
        $delete_brand_id = $_POST['delete_brand_id'];
        $check_query = "SELECT * FROM brand_table WHERE brand_id='$delete_brand_id'";
        $check_query_run = mysqli_query($conn, $check_query);

        foreach($check_query_run as $rows){

            if ($img_path = "upload/".$rows['brand_img']){

                $product_query = "UPDATE product_table 
                                SET brand_id=NULL
                                WHERE brand_id='$delete_brand_id'";
                $product_query_run = mysqli_query($conn, $product_query);

                $query = "DELETE FROM brand_table WHERE brand_id ='$delete_brand_id'";
                $query_run = mysqli_query($conn, $query);

                if ($query_run && $product_query_run){
                    unlink($img_path);
                    echo "<span><i class='bx bxs-error'></i></span> Delete successfully. Please edit the products which belongs to this brand.";
                }else{
                    echo "Error: Not success";
                }
            }
        }
    }

    // edit brand 
    if (isset($_POST["edit_brand_id"])){
        $brand_id = $_POST['edit_brand_id'];
        $brand_name = $_POST['new_brand_name'];
        $category_id = $_POST['brand_belong_category'];
        $brand_img = $_FILES["brand_img"]['name'];

        $brand_query = "SELECT * FROM brand_table WHERE brand_id = '$brand_id'";
        $brand_query_run = mysqli_query($conn, $brand_query);

        foreach ($brand_query_run as $brand_row){
            if ($brand_img == NULL){
                // update existed img
                $img_data = $brand_row['brand_img'];
            }else{
                if ($img_path = "upload/".$brand_row['brand_img']){
                    unlink($img_path);
                    $img_data = $brand_img;
                }
            }
        }
        $query = "UPDATE brand_table
                
                SET brand_name = '$brand_name',
                    brand_img = '$img_data',
                    category_id = '$category_id'
                
                WHERE brand_id = '$brand_id'";
        
        $query_run = mysqli_query($conn, $query);
        if ($query_run){
            if ($brand_img == NULL){
                // echo "update existing img";
                echo "<span><i class='bx bxs-check-circle'></i></span>Brand Save Changed 📦!";
            }else{

                move_uploaded_file($_FILES["brand_img"]['tmp_name'], "upload/".$img_data);
                echo "<span><i class='bx bxs-check-circle'></i></span>Brand Save Changed 📦!";
            }
        }else{
            echo "Error: Something wrong";
        }

    }



    // dynamic drop down list

    if(isset($_POST['get_option'])){
        $brand = $_POST['get_option'];
        
        $find_query = "SELECT * FROM brand_table WHERE category_id = '$brand'";
        $find_query_run = mysqli_query($conn, $find_query);

        while($row = mysqli_fetch_array($find_query_run)){

            echo "<option value='" .$row["brand_id"]. "'   >" . $row["brand_name"] . "</option>";

        }
        exit;
    }




    // add new product
    if (isset($_POST['product_name'])){
        $product_name = $_POST["product_name"];
        $product_price = $_POST["product_price"];
        $brand_id = $_POST["product_belong_brand"];
        $category_id = $_POST["product_belong_category"];

        $product_query = "INSERT INTO `product_table`(`product_name`, `product_price`, `brand_id`, `category_id`) VALUES ('$product_name','$product_price','$brand_id','$category_id')";
        $product_query_run = mysqli_query($conn, $product_query);
        if ($product_query_run){
            echo "<span><i class='bx bxs-check-circle'></i></span>Product Added Succesfully 🥫!";
        }else{
            echo "Error: Something wrong";
        }
    }

    // delete product
    if (isset($_POST["delete_product_id"])){
        $product_id = $_POST['delete_product_id'];
        $check_query = "DELETE FROM product_table WHERE product_id ='$product_id'";
        $check_query_run = mysqli_query($conn, $check_query);

        if ($check_query_run){
            echo "<span><i class='bx bxs-error'></i></span> Delete product successfully.";
        }else{
            echo "Error: Not success";
        }
    }



    // edit product
    if (isset($_POST["edit_product_id_2"])){
        $product_id = $_POST['edit_product_id_2'];
        $product_name = $_POST['new_product_name'];
        $product_price = $_POST['product_price'];
        $category_id = $_POST['product_belong_category'];
        $brand_id = $_POST['product_belong_brand'];
        


        $product_query = "UPDATE product_table
                        
                        SET product_name = '$product_name',
                            product_price = $product_price,
                            brand_id = '$brand_id',
                            category_id = '$category_id'
                            
                        WHERE product_id = $product_id";

        $product_query_run = mysqli_query($conn, $product_query);

        if ($product_query_run){
            echo "<span><i class='bx bxs-check-circle'></i></span>Product Save Changed 🥫!";
        }else{
            echo "Error: Not success";
        }
        
    }


    
    exit

?>