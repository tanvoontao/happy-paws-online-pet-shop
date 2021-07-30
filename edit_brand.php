<?php
require "setting/settings.php";
$edit_brand_id = $_POST['edit_brand_id'];
$nav_category_id = $_POST['nav_category_id'];

function isCategorySelected($category_id, $current_cateogory_id){
    if ($current_cateogory_id == $category_id){
        return "selected";
    }else{
        return "";
    }
}


$query_2 = "SELECT * FROM brand_table WHERE brand_id='$edit_brand_id'";


$query_run = mysqli_query($conn, $query_2);

$row = mysqli_fetch_assoc($query_run);


$category_option_query = "SELECT * FROM category_table";

$category_option_query_run = mysqli_query($conn, $category_option_query);

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
        <input type="hidden" name="edit_brand_id" value="'.$row['brand_id'].'"/>
        <div class="inputText">
            <input type="text" id="new_brand_name" name="new_brand_name" value="'.$row['brand_name'].'" required>
            <span></span>
            <label>📦 New Brand Name</label><br/>
        </div>
        <div>
            <span class="input_img_heading">Select category</span><br/>
            <select name="brand_belong_category" required>';
               
                if (mysqli_num_rows($category_option_query_run) > 0){
                    while($row_1 = mysqli_fetch_assoc($category_option_query_run)){
                        $selected_category = isCategorySelected($row_1["category_id"], $nav_category_id);
                        echo "
                            <option value='" .$row_1["category_id"]. "'".$selected_category.">" . $row_1["category_name"] . "</option>
                        ";
                    }
                }
              echo '  
            </select>
        </div>

        <p>*Don\'t need to upload new image if you want to reuse same image.</p>

        
        <div class="wrapper_input_file">
            <span class="input_img_heading">Brand Image</span>
            <div class="drag-area">
                
                <div class="thumbnail_in_drop_area" data-label="'.$row['brand_img'].'" ><img class="category_img_src" src="upload/'.$row['brand_img'].'" alt= "'.$row['brand_img'].'"/></div>
                <input type="file" onchange="readURL(this);" id="brand_img" name="brand_img"  class="file_input" value="'.$row['brand_img'].'" >

            </div>
        </div>
                
                
        
    </div>
    <div class="form_btn">
        <button type="reset" class="cancel_btn" onclick="closeEditCategoryModal()">Cancel</button>
        <button type="submit" name="edit_category_save">Save</button>
    </div>

</form>
</div>
';
//<img src="upload/'.$row['category_img'].'" alt= "'.$row['category_img'].'"/>
?>