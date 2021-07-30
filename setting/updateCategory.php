<?php
require "settings.php";

    echo "
    

    <!-- add category -->
    <li class='category_box addOn' onclick='openForm()'>
        <div class='addOnContainer'>
            <i class='bx bx-plus'></i>
            <p>Add new category</p>
        </div>
        
    </li>
    ";

    $query_category = "SELECT * FROM category_table";
    $query_category_result = mysqli_query($conn, $query_category);

    if (mysqli_num_rows($query_category_result) > 0){
        while($row = mysqli_fetch_assoc($query_category_result)){
            echo "
            <li class='category_box'>
                <div class='image_box'>
                    <div style='background-image: linear-gradient(to top, #006d77 -50%, transparent),url(upload/" . $row["category_img"] . ")'></div>
                    <p>" . $row["category_name"] . "</p>
                </div>
                <div class='button'>
                
                
                    <button name='edit_category_id' data-category-id='" . $row["category_id"] . "' class='edit_btn'><i class='bx bx-edit-alt'></i> Edit</button>

                
                    <button name='delete_category' data-category-id='" . $row["category_id"] . ",".$row["category_name"]."' class='delete_btn'><i class='bx bx-trash'></i> Delete</button>
                
                </div>
                
            </li>
            ";
        }
    }



    

?>