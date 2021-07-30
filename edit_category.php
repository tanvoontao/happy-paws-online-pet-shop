<?php
require "setting/settings.php";
$edit_category_id = $_POST['edit_category_id'];



$query_2 = "SELECT * FROM category_table WHERE category_id='$edit_category_id'";


$query_run = mysqli_query($conn, $query_2);

$row = mysqli_fetch_assoc($query_run);
echo '
<div class="modal_box edit">
    <div class="form_heading">
        <p>✍️ Edit category</p>
    </div>
    <hr/>
';


echo '
<form method="POST" class="edit_category_form" enctype="multipart/form-data">
    <div class="form_content">
        <input type="hidden" name="edit_category_id" value="'.$row['category_id'].'"/>
        <div class="inputText">
            <input type="text" id="new_category_name" name="new_category_name" value="'.$row['category_name'].'" required>
            <span></span>
            <label>📦 New Category Name</label><br/>
        </div>

        <p>*Don\'t need to upload new image if you want to reuse same image.</p>

        
        <div class="img_input_container">
                <div class="wrapper_input_file">
                    <span class="input_img_heading">Category Image</span>
                    <div class="drag-area">
                        
                        <div class="thumbnail_in_drop_area" data-label="'.$row['category_img'].'" ><img class="category_img_src" src="upload/'.$row['category_img'].'" alt= "'.$row['category_img'].'"/></div>
                        <input type="file" onchange="readURL(this);" id="new_category_img" name="new_category_img"  class="file_input" value="'.$row['category_img'].'" >

                    </div>
                </div>
                
                <div class="wrapper_input_file">
                    <span class="input_img_heading">Category Icon Image</span>

                    <div class="drag-area">
                        
                        <div class="thumbnail_in_drop_area" data-label="'.$row['category_icon_img'].'" );"><img class="category_img_src" src="upload/'.$row['category_icon_img'].'" alt= "'.$row['category_icon_img'].'"/></div>
                        <input type="file" id="new_category_icon_img" onchange="readURL(this);" name="new_category_icon_img"  class="file_input" value="'.$row['category_icon_img'].'" >

                    </div>

                    
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