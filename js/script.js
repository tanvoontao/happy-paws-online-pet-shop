let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#menu_btn");

function closeMenu(){
    sidebar.classList.toggle("close");
    menuBtnChange();
}

function closeaaa(){
    let notification = document.querySelector(".notification");
    notification.classList.add("close");
}

function menuBtnChange() {
    if(sidebar.classList.contains("close")){
        closeBtn.classList.replace("bx-menu-alt-right","bx-menu");

    }else {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    }
}

function openForm(){
    let modal_box = document.querySelector(".form_modal_for_add_new_category");
    modal_box.classList.remove("default")
}


// close form modal box function
document.querySelectorAll(".closeFormModal").forEach((closeModalBtn) => {
    closeModalBtn.addEventListener("click", function(){
        closeModal()
    })
})

function closeModal(){
    let modal_box = document.querySelector(".form_modal_for_add_new_category");
    modal_box.classList.add("default");

    document.querySelectorAll(".drop-zone__input").forEach((imgFileInputElement) => {
        const dropZoneElement = imgFileInputElement.closest(".drag-area");
        dropZoneElement.classList.remove("active");
        dropZoneElement.querySelector(".dragText").style.display = "";
        dropZoneElement.querySelector(".icon").style.display = "";
        dropZoneElement.children[1].textContent = "Drag & Drop or Click to Upload Image File";
        dropZoneElement.querySelector(".thumbnail_in_drop_area").remove();
    })
}

function closedeleteModal(){
    let modal_box = document.querySelector(".sureToDelete_bg");
    modal_box.classList.add("default");
}


function showNotificationAfterAction(response){
    $("#notice").html(response);
    let notification = document.querySelector(".notification");
    notification.classList.remove("close");
}

// validate according url
function updateData(){
    let currentUrlArr = (window.location.pathname).split("/");

    let currentUrl = currentUrlArr[currentUrlArr.length - 1]

    
    
    if (currentUrl == "manage_categories.php"){

        
        $('#categories_container').load("setting/updateCategory.php");

    }else if (currentUrl == "manage_brands.php"){

        let nav_category_id_1 = $(".categories_nav_bar li.active_cat_nav");
        
        let nav_category_id_2 = nav_category_id_1.attr("data-category-id");

        $('#brand_container_wrapper').load("setting/updateBrand.php", {nav_category_id: nav_category_id_2});
    }else if(currentUrl == "manage_products.php"){
        let nav_category_id_1 = $(".categories_nav_bar li.active_cat_nav");
        // current category id
        let nav_category_id_2 = nav_category_id_1.attr("data-category-id");
        //console.log(brand_id) - global variable
        // current brand id
        $(".product_table").load("setting/updateProduct.php", {nav_category_id: nav_category_id_2, brand_id: brand_id});


    }
}








/*#################### Drag and Drop function #################### */


// drag and drop img file 

document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    
    
    // closest() = Find the closest element which matches the CSS selector
    const dropZoneElement = inputElement.closest(".drag-area");
    const dragText = dropZoneElement.children[1];
    // click this will select input type file
    dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
    });

    // change the thubnail and do validation
    inputElement.addEventListener("change", (e) => {
        
        isOk = getValueImg(dropZoneElement, inputElement);
        
        let len = inputElement.files.length;
        if (isOk){
            if (len) { // file object length gobeyong 0
                updateThumbnail(dropZoneElement, inputElement.files[0]);
            }
        }
        
    })



    dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("active");
        dragText.textContent = "Release to Upload Image File";
    });
    

    // drage leave is drag outside the box
    // drag end is click esc key to escape the drag
    ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
            dropZoneElement.classList.remove("active");
            dragText.textContent = "Drag & Drop or Click to Upload Image File";
        })
    });


    dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();
        
        
        isOk = getValueImg2(dropZoneElement, e.dataTransfer.files[0]);

        let len2 = e.dataTransfer.files.length;

        if (isOk){
            if (len2) {
                //inputElement.files = e.dataTransfer.files;
                updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
            }
        }
        
        dropZoneElement.classList.remove("active");
    });


});


// <div class="thumbnail_in_drop_area" data-label="tgile.txt"></div>




// click and browse img validation
function getValueImg(dropZoneElement, img){
    
    imgVal = img.value;
    
    let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.svg)$/i;

    let thumbnailElement = dropZoneElement.querySelector(".thumbnail_in_drop_area");

    if (!allowedExtensions.exec(imgVal)){
        alert ("This is not an Image File!");
        img.value = "";
        if(!thumbnailElement){
            dropZoneElement.classList.remove("active");
            dropZoneElement.querySelector(".dragText").style.display = "";
            dropZoneElement.querySelector(".icon").style.display = "";
            dropZoneElement.children[1].textContent = "Drag & Drop or Click to Upload Image File";
            return false;
        }else{
            dropZoneElement.querySelector(".thumbnail_in_drop_area").remove();
            dropZoneElement.classList.remove("active");
            dropZoneElement.querySelector(".dragText").style.display = "";
            dropZoneElement.querySelector(".icon").style.display = "";
            dropZoneElement.children[1].textContent = "Drag & Drop or Click to Upload Image File";
            return false;
        }
        
    }else{
        return true;
    }
}



// update thumbnail
function updateThumbnail(dropZoneElement, file){
    let thumbnailElement = dropZoneElement.querySelector(".thumbnail_in_drop_area");
    if (dropZoneElement.querySelector(".dragText")) {
        dropZoneElement.querySelector(".dragText").style.display = "none";
        dropZoneElement.querySelector(".icon").style.display = "none";
    }
    if (!thumbnailElement) {
        thumbnailElement = document.createElement("div");
        thumbnailElement.classList.add("thumbnail_in_drop_area");
        dropZoneElement.appendChild(thumbnailElement);
    }
    thumbnailElement.dataset.label = file.name;
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
        thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
    };

}


// drag and drop img validation
// for some reason, function similar but not work well
function getValueImg2(dropZoneElement, file){
    let fileType = file.type;
    let validExtensions = ["image/jpeg", "image/jpg", "image/png", "image/svg+xml"];
    
    

    let thumbnailElement = dropZoneElement.querySelector(".thumbnail_in_drop_area");

    // if (!allowedExtensions.exec(imgVal))
    if (!validExtensions.includes(fileType)){
        alert ("This is not an Image File!");
        //img.value = "";
        if(!thumbnailElement){
            dropZoneElement.classList.remove("active");
            dropZoneElement.querySelector(".dragText").style.display = "";
            dropZoneElement.querySelector(".icon").style.display = "";
            dropZoneElement.children[1].textContent = "Drag & Drop or Click to Upload Image File";
            return false;
        }else{
            dropZoneElement.querySelector(".thumbnail_in_drop_area").remove();
            dropZoneElement.classList.remove("active");
            dropZoneElement.querySelector(".dragText").style.display = "";
            dropZoneElement.querySelector(".icon").style.display = "";
            dropZoneElement.children[1].textContent = "Drag & Drop or Click to Upload Image File";
            return false;
        }
        
    }else{
        return true;
    }
}
/*#################### Drag and Drop function END #################### */




/*#################### Add NEW Category #################### */
// submit add new category form
$(document).on('submit', '.add_category_form', function(e){
    e.preventDefault();
    //let response = [];
    
    $.ajax({
        type: "POST",
        url: "code2.php",

        // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        data: new FormData(this),

        // The content type used when sending data to the server.
        contentType: false,

        // To unable request pages to be cached
        cache: false, 

        // To send DOMDocument or non processed data file it is set to false
        processData: false,
        
        success: function(response){
            //console.log(response)
            //alert(response)
            showNotificationAfterAction(response);
            

            closeModal();

            updateData();
            
            
            
        }
    });
});
/*#################### Add NEW Category END #################### */



/*#################### Delete Category #################### */

$(document).on("click", ".delete_btn", function(){

    let categoryArr = this.getAttribute("data-category-id").split(",");
    let category_id = categoryArr[0];
    let category_name = categoryArr[1];
    let modal_box = document.querySelector(".sureToDelete_bg");
    modal_box.classList.remove("default")
    

    let currentUrlArr = (window.location.pathname).split("/");

    let currentUrl = currentUrlArr[currentUrlArr.length - 1]

    if (currentUrl == "manage_categories.php"){

        
        $('.sureToDelete_bg').load("include/deletemodal.php", {category: category_id, category_n: category_name});

    }else if (currentUrl == "manage_brands.php"){

        $('.sureToDelete_bg').load("include/deleteModal_brand.php", {category: category_id, category_n: category_name});
    }else if (currentUrl == "manage_products.php"){

        $('.sureToDelete_bg').load("include/deleteModal_product.php", {category: category_id, category_n: category_name});
    }

    


})

// delete category
$(document).on('submit', '.delete_form', function(e){
    e.preventDefault();
    
    $.ajax({
        type: "POST",
        url: "code2.php",
        data: new FormData(this),
        contentType: false,
        cache: false, 
        processData: false,

        success: function(response){
            //console.log(response)


            showNotificationAfterAction(response);
            

            closedeleteModal();

            updateData();
            

            
        }
    });
})
/*#################### Delete Category END #################### */



/*#################### Edit Category #################### */

$(document).on("click", ".edit_btn", function(){
    let edit_category_id = this.getAttribute("data-category-id");
    let modal_box = document.querySelector(".edit_category_bg");
    modal_box.classList.remove("default")
    
    let currentUrlArr = (window.location.pathname).split("/");

    let currentUrl = currentUrlArr[currentUrlArr.length - 1]

    if (currentUrl == "manage_categories.php"){

        
        
        $('.edit_category_bg').load("edit_category.php", {edit_category_id: edit_category_id});

    }else if (currentUrl == "manage_brands.php"){
        //console.log("hey");
        let nav_category_id_1 = $(".categories_nav_bar li.active_cat_nav");
        
        let nav_category_id_2 = nav_category_id_1.attr("data-category-id");
        
        

        $('.edit_category_bg').load("edit_brand.php", {edit_brand_id: edit_category_id, nav_category_id: nav_category_id_2});
    }else if (currentUrl == "manage_products.php"){
        
        let nav_category_id_1 = $(".categories_nav_bar li.active_cat_nav");
        
        let nav_category_id_2 = nav_category_id_1.attr("data-category-id");
        
        

        $('.edit_category_bg').load("edit_product.php", {edit_brand_id: edit_category_id});
    }

    
})

function closeEditCategoryModal(){
    let modal_box = document.querySelector(".edit_category_bg");
    modal_box.classList.add("default");
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            let thumbnailElement = input.closest(".drag-area").querySelector(".thumbnail_in_drop_area");
            let imgElement = input.closest(".drag-area").querySelector(".category_img_src");
            //imgElement.attr('src', e.target.result);
            imgElement.setAttribute("src", e.target.result);
            thumbnailElement.dataset.label = input.files[0].name;
        };

        reader.readAsDataURL(input.files[0]);
    }
}


$(document).on('submit', '.edit_category_form', function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "code2.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response){
            //console.log(response)
            showNotificationAfterAction(response);
            

            closeEditCategoryModal();

            updateData();
            
        }
    });
})

/*#################### Edit Category END #################### */





/*#################### Add Brand #################### */
$(".categories_nav_bar li").click(function(){
    
    $(".categories_nav_bar li").removeClass("active_cat_nav");
    $(this).addClass("active_cat_nav");

    let nav_category_id = $(this).attr("data-category-id");
    

    // load and update brand
    // if not set then we choose the first one and also load the first one
    $("#brand_container_wrapper").load("setting/updateBrand.php", {nav_category_id: nav_category_id});
    //$(".form_modal_for_add_new_category").load("setting/add_new_product_modal.php", {nav_category_id: nav_category_id})
    $(".checkbox_filter_brand").load("setting/brand_nav_checkBox.php", {nav_category_id: nav_category_id});
    $(".product_table").load("setting/updateProduct.php", {nav_category_id: nav_category_id});

})

/*#################### Add Brand END #################### */




var brand_id;

// get brand selected data to filter the product

$('.checkbox_filter_brand').on('click','.brand_selected',function(){
    

    filter_data();

    function filter_data(){
        brand_id = get_filter("brand");
        
        let nav_category_id = ($("li.active_cat_nav")).attr("data-category-id");
        
        // ajax if success then load update product
        $(".product_table").load("setting/updateProduct.php", {nav_category_id: nav_category_id, brand_id: brand_id});
    }

    function get_filter(class_name){
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        
        return filter;
    }

});



$("#logout_btn").click(function(event){
    firebase.auth().signOut();
    window.location.replace("login.php");
})