<?php
$category_id = $_POST['category'];
$category_name = $_POST['category_n'];

echo '
<div class="sureToDelete_modalBox">
    <p>Sure to delete ?</p>
    <hr/>
    <p>You will not access category "<span class="deleteCategory">'.$category_name.'</span>" again.</p>
    <p>After delete, please not to forget to 
        change the products or brands belong to 
        this category. </p>
    <form class="delete_form" action="code2.php">
    
        <input type="hidden" name="delete_category_id" value="'.$category_id.'"/>

        <div class="form_btn">
            
            <button type="reset"  class="cancel_btn" onclick="closedeleteModal()">Cancel</button>
            <button type="submit" name="#" >Delete !</button>
        </div>
    </form>
    
    
</div>
';
?>