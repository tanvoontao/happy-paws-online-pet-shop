<?php
require "settings.php";
    if (!isset($_POST["nav_category_id"])){
        //if not set, get the first
        $query_category = "SELECT * FROM category_table";
        $query_category_run = mysqli_query($conn, $query_category);
        $row = mysqli_fetch_assoc($query_category_run);
        $current_category_id = $row['category_id'];
        $brand_query = "SELECT * FROM brand_table WHERE category_id='$current_category_id'";
        
        

    }else{
        // if null, then get null
        if (($_POST["nav_category_id"]) == "NULL" ){
            $current_category_id = NULL;
            $brand_query = "SELECT * FROM brand_table WHERE category_id IS NULL";
        }
        // else get the nav id
        else{
            $current_category_id = $_POST["nav_category_id"];
            $brand_query = "SELECT * FROM brand_table WHERE category_id='$current_category_id'";
        }
    }
    
    $brand_query_run = mysqli_query($conn, $brand_query);
    $count = mysqli_num_rows($brand_query_run);
    $count += 1;
    
echo "
<ul class='brand_container' style='grid-template-rows: repeat(". $count .",120px);'>
<li class='brand_modal addOn' onclick='openForm()'>
    <div class='addOnContainer'>
        <i class='bx bx-plus'></i>
        <p>Add new brand</p>
    </div>
</li>
";
    
    if (mysqli_num_rows($brand_query_run) > 0){
        while($row = mysqli_fetch_assoc($brand_query_run)){
            echo "
            <li>
                <div class='brand_detail'>
                    <img src='upload/".$row['brand_img']."'/>
                    <p>".$row['brand_name']."</p>
                </div>
                

                <div class='button_brand'>
                            
                    
                    <button name='edit_brand_id' data-category-id='" . $row["brand_id"] . "' class='edit_btn'><i class='bx bx-edit-alt'></i> Edit</button>

                    
                    <button name='delete_brand' data-category-id='" . $row["brand_id"] . ",".$row["brand_name"]."' class='delete_btn'><i class='bx bx-trash'></i> Delete</button>
                
                </div>

            </li>
            ";
        }
    }
echo "</ul>";
    

?>