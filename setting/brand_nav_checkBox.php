<?php
require "settings.php";

if (!isset($_POST["nav_category_id"])){
    //if not set, get the first
    $brand_query = "SELECT * FROM brand_table";
    $brand_query_run =  mysqli_query($conn, $brand_query);
    $row = mysqli_fetch_assoc($brand_query_run);
    $current_category_id = $row['category_id'];
    $brand_query = "SELECT * FROM brand_table WHERE category_id='$current_category_id'";

}else{
    $current_category_id = $_POST['nav_category_id'];
    $brand_query = "SELECT * FROM brand_table WHERE category_id='$current_category_id'";
}
$brand_query_run =  mysqli_query($conn, $brand_query);
if (mysqli_num_rows($brand_query_run) > 0){
    while($row = mysqli_fetch_assoc($brand_query_run)){
        echo '
        <li>
            <label for="'.$row['brand_id'].'">
                <input type="checkbox" id="'.$row['brand_id'].'" class="brand_selected brand" value="'.$row['brand_id'].'"/> '.$row['brand_name'].'
            </label>
        </li>
        ';
    }
}

?>