<?php
$category_id = $_POST['category'];
$category_name = $_POST['category_n'];
// rmb to myself, even variable name is category but this are reuse
// for brand and category

echo '
<div class="sureToDelete_modalBox">
    <p>Sure to delete ?</p>
    <hr/>
    <p>You will not access brand "<span class="deleteCategory">'.$category_name.'</span>" again.</p>
    <p>After delete, please not to forget to 
        change the products belong to 
        this brand. </p>
    <form class="delete_form" action="code2.php">
    
        <input type="hidden" name="delete_brand_id" value="'.$category_id.'"/>

        <div class="form_btn">
            
            <button type="reset"  class="cancel_btn" onclick="closedeleteModal()">Cancel</button>
            <button type="submit" name="#" >Delete !</button>
        </div>
    </form>
    
    
</div>
';
?>