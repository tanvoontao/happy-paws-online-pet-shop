<?php
$product_id = $_POST['category'];
$product_name = $_POST['category_n'];

echo '
<div class="sureToDelete_modalBox">
    <p>Sure to delete ?</p>
    <hr/>
    <p>You will not access product "<span class="deleteCategory">'.$product_name.'</span>" again.</p>
    
    <form class="delete_form" action="code2.php">
    
        <input type="hidden" name="delete_product_id" value="'.$product_id.'"/>

        <div class="form_btn">
            
            <button type="reset"  class="cancel_btn" onclick="closedeleteModal()">Cancel</button>
            <button type="submit" name="#" >Delete !</button>
        </div>
    </form>
    
    
</div>
';

?>