<?php
require "settings.php";



echo '
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
';

if ((!isset($_POST["brand_id"])) || (!isset($_POST["nav_category_id"]))){
    /*
    $product_query = "SELECT * FROM product_table";
    
    $product_query_run = mysqli_query($conn, $product_query);

    $row = mysqli_fetch_assoc($product_query_run);

    $nav_category_id = $row['category_id'];
    $brand_id = $row['brand_id'];

    $product_query = "SELECT * FROM product_table WHERE category_id = '$nav_category_id' AND brand_id = '$brand_id' ";
    $product_query_run = mysqli_query($conn, $product_query);*/
    if ((($_POST["nav_category_id"])== "NULL")){
        $product_query = "SELECT * FROM product_table WHERE category_id IS NULL OR brand_id IS NULL";
        $product_query_run = mysqli_query($conn, $product_query);


        $count = 0;
        if (mysqli_num_rows($product_query_run) > 0){
            while($row = mysqli_fetch_assoc($product_query_run)){
                $count += 1;
                echo "
                <tr>
                    <td>".$count."</td>
                    <td>".$row['product_name']."</td>
                    <td class='product_price'>RM ".$row['product_price']."</td>
                    <td class='button_brand_2'>
                    
                        <button name='edit_brand_id' data-category-id='" . $row["product_id"] . "' class='edit_btn'><i class='bx bx-edit-alt'></i> Edit</button>
                        
                        <button name='delete_brand' data-category-id='" . $row["product_id"] . ",".$row["product_name"]."' class='delete_btn'><i class='bx bx-trash'></i> Delete</button>

                    </td>
                </tr>
                ";
            }
        }
    }else{
        echo "
        <tr>
            <td colspan='4'>
                Please select category and brands to show the product data.
            </td>
        </tr>
        ";
    }
    

}else{

    
    $brand_filter = implode("','", $_POST["brand_id"]);
    $nav_category_id = $_POST['nav_category_id'];
    $product_query = "SELECT * FROM product_table WHERE category_id = '$nav_category_id' AND brand_id IN('".$brand_filter."') ";
    
    $product_query_run = mysqli_query($conn, $product_query);


    $count = 0;
    if (mysqli_num_rows($product_query_run) > 0){
        while($row = mysqli_fetch_assoc($product_query_run)){
            $count += 1;
            echo "
            <tr>
                <td>".$count."</td>
                <td>".$row['product_name']."</td>
                <td class='product_price'>RM ".$row['product_price']."</td>
                <td class='button_brand_2'>
                
                    <button name='edit_brand_id' data-category-id='" . $row["product_id"] . "' class='edit_btn'><i class='bx bx-edit-alt'></i> Edit</button>
                    
                    <button name='delete_brand' data-category-id='" . $row["product_id"] . ",".$row["product_name"]."' class='delete_btn'><i class='bx bx-trash'></i> Delete</button>

                </td>
            </tr>
            ";
        }
    }

}


?>