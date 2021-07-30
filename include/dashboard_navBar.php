<?php
    $link = array(
        array("manage_categories.php", "<i class='bx bx-category-alt'></i>", "Manage Categories"),
        array("manage_brands.php", "<i class='bx bx-purchase-tag'></i>", "Manage Brands"),
        array("manage_products.php", "<i class='bx bx-slider-alt'></i>", "Manage Products")
    );

    function active_link($currect_page){
        $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
        $url = end($url_array);  
        if($currect_page == $url){
            return 'active'; //class name in css 
        }else{
            return "";
        }
    }


    echo "
    <div class='logo-details'>

        <img src='img/logo.png' alt='Happy Paws Logo'/>
        <div class='logo_name'>Happy Paws</div>
        <i class='bx bx-menu-alt-right'  id='menu_btn' onclick='closeMenu()'></i>

    </div>
    ";
    echo "<ul class='nav-list'>";
    foreach ($link as $single_link){
        $active = active_link($single_link[0]);
        
        echo "
        <li>
            <a href='" . $single_link[0] . "' id='" . $active . "'>"
                . $single_link[1] . 
                "<span class='links_name'>" . $single_link[2] . "</span>
            </a>
            <span class='tooltip'>" . $single_link[2] . "</span>
        </li>
        ";
    }
    echo "</ul>";
    

?>
