<?php
require "setting/settings.php";
$edit_product_id = $_POST['edit_brand_id'];
//$nav_category_id = $_POST['nav_category_id'];
function isCategorySelected($category_id, $current_cateogory_id){
    if ($current_cateogory_id == $category_id){
        return "selected";
    }else{
        return "";
    }
}


$product_query = "SELECT * FROM product_table WHERE product_id='$edit_product_id'";
$product_query_run =  mysqli_query($conn, $product_query);
$row = mysqli_fetch_assoc($product_query_run);
$current_cat_id = $row['category_id'];
$current_brand_id = $row['brand_id'];

$category_option_query = "SELECT * FROM category_table";

$category_option_query_run = mysqli_query($conn, $category_option_query);




$brand_option_query = "SELECT * FROM brand_table";

$brand_option_query_run = mysqli_query($conn, $brand_option_query);

echo '
<div class="modal_box edit">
    <div class="form_heading">
        <p>✍️ Edit brand</p>
    </div>
    <hr/>
';

echo '
<form method="POST" class="edit_category_form" enctype="multipart/form-data">
    <div class="form_content">
        <input type="hidden" name="edit_product_id_2" value="'.$row['product_id'].'"/>
        <div class="inputText">
            <input type="text" id="new_product_name" name="new_product_name" value="'.$row['product_name'].'" required>
            <span></span>
            <label>🥫 New Product Name</label><br/>
        </div>

        <div class="inputText">
            <input type="text" id="product_price" name="product_price" placeholder="100.33" value="'.$row['product_price'].'" required>
            <span></span>
            <label>💸 Product Price (RM)</label><br/>

        </div>

        <div>
            <span class="input_img_heading">Select category</span><br/>
            
            <select name="product_belong_category" onchange="fetch_select(this.value);" required>';
               
                if (mysqli_num_rows($category_option_query_run) > 0){
                    while($row_1 = mysqli_fetch_assoc($category_option_query_run)){
                        $selected_category = isCategorySelected($row_1["category_id"], $current_cat_id);
                        echo "
                            <option value='" .$row_1["category_id"]. "'".$selected_category.">" . $row_1["category_name"] . "</option>
                        ";
                    }
                }
              echo '  
            </select>
        </div>

        
        
        <div>
            <span class="input_img_heading">Select brand</span><br/>
            <select name="product_belong_brand" id="selecte_brand_2" required>
                <option value=""> - Select Brand - </option>';
                if (mysqli_num_rows($brand_option_query_run) > 0){
                    while($row_2 = mysqli_fetch_assoc($brand_option_query_run)){
                        $selected_category = isCategorySelected($row_2["brand_id"], $current_brand_id);
                        echo "
                            <option value='" .$row_2["brand_id"]. "'".$selected_category.">" . $row_2["brand_name"] . "</option>
                        ";
                    }
                }
                echo '
            </select>
        </div>
                
                
        
    </div>
    <div class="form_btn">
        <button type="reset" class="cancel_btn" onclick="closeEditCategoryModal()">Cancel</button>
        <button type="submit" name="edit_category_save">Save</button>
    </div>

</form>
</div>
';
?>