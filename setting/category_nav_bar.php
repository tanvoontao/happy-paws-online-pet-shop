<?php
require "settings.php";

$category_query = "SELECT * FROM category_table";
$category_query_run =  mysqli_query($conn, $category_query);
if (mysqli_num_rows($category_query_run) > 0){
    while($row = mysqli_fetch_assoc($category_query_run)){
        echo '
        <li data-category-id="'.$row['category_id'].'">
            <img src="upload/'.$row['category_icon_img'].'"/>
            <button>'.$row['category_name'].'</button>
        </li>
        ';
    }
}
echo '
<li data-category-id="NULL">
    <button>Things without category or brand</button>
</li>
';


?>