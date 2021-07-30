

var addToCartBtnAnimatio = document.getElementsByClassName('addToCart_btn');

for ( var i = 0; i < addToCartBtnAnimatio.length; i++ ){

    var animatedBtn = addToCartBtnAnimatio[i];
    animatedBtn.addEventListener('click', addToCartClickedAnimation)

}

function addToCartClickedAnimation(event){
    let btn = event.target.nodeName;
    if ((btn == "P") || (btn == "SPAN")){
        btn = event.target.parentElement;
    }
    else{
        btn = event.target;
    }
    
    variationOK = chkVariation(btn);
    if (variationOK){
        addtoCartClickedToGetInfo(btn);
        let cart = btn.children[0];
        let text = btn.children[1];
        
    
        if (!document.getElementsByClassName('cart_Animation').length) {
    
            cart.classList.add('cart_Animation');
    
            //cart.style.animation = "0.5s moveCart ease-in";
            //cart.style.animationFillMode = "forwards";
    
    
            text.classList.add('text_Animation');
            btn.classList.add('button_Animation');
            setTimeout(function () { resetAnimation(cart, text, btn); }, 1500);
        }
        // reset
        let variation = btn.parentElement.children[0];
        variation.selectedIndex = 0;
    }
    else{
        let alertBox = document.querySelector(".overlay_bg");
        let popUpAlertBox = document.querySelector(".popUpAlertBox");
        alertBox.classList.remove("default");
        popUpAlertBox.classList.add("open");

    }
    
}

function resetAnimation(cart, text, button){
    
    cart.classList.remove('cart_Animation');
    text.classList.remove('text_Animation');
    button.classList.remove('button_Animation');
}

function chkVariation(btn){
    let variation = btn.parentElement.children[0].value;
    
    if (variation == " "){
        return false
    }
    else{
        return true
    }

}

function closeAlertBox(){
    let alertBox = document.querySelector(".overlay_bg");
    let popUpAlertBox = document.querySelector(".popUpAlertBox");
    popUpAlertBox.classList.remove("open");
    alertBox.classList.add("default");
    
}



function addtoCartClickedToGetInfo(btn){
    let wholeProductCard = btn.parentElement.parentElement.parentElement;
    let brand = wholeProductCard.children[1].children[0].innerText;
    let productArray = (wholeProductCard.children[1].children[1].children[0].value).split(",");
    let productName = productArray[0];



    let title = brand + " - " + productName
    let price = productArray[1];
    let imgSrc = wholeProductCard.children[0].src;
    addToCartItemStoreInLocalStorage(title, price,imgSrc);
}

function addToCartItemStoreInLocalStorage(title, price,imgSrc){
    let happyPaws_cartItems = [];
    price = price.replace("RM ", "");
    price = parseFloat(price);
    let item = {
        name: title,
        price: price,
        img: imgSrc,
        count: 1
    }
    
    if (typeof(Storage) !== "undefined"){ // local storage support

        // if not existed, create one
        if ( JSON.parse(localStorage.getItem('happyPaws_cartItems')) === null ){

            happyPaws_cartItems.push(item);
            localStorage.setItem('happyPaws_cartItems',JSON.stringify(happyPaws_cartItems));
            updateCartCounter()


        }else{ // existed

            // retrieve
            let happyPaws_cartItems = JSON.parse(localStorage.getItem("happyPaws_cartItems"));
            let repeat = false; // chech if there is repeated items

            for ( var itemInside in happyPaws_cartItems ){
                if ( happyPaws_cartItems[itemInside].name == item.name ){

                    happyPaws_cartItems[itemInside].count ++;
                    localStorage.setItem('happyPaws_cartItems',JSON.stringify(happyPaws_cartItems));
                    repeat = true
                    updateCartCounter()

                }
            }
            if (!repeat){
                happyPaws_cartItems.push(item);
                localStorage.setItem('happyPaws_cartItems',JSON.stringify(happyPaws_cartItems));
                updateCartCounter()

            }

        }

    }else{ // not support 
        alert('local storage is not working on your browser');
    }
}








/*multiple event*/
function forMultipleAddButtonEventUpdate(){
    var add = document.getElementsByClassName("add");
    for (var i = 0; i < add.length; i++) {
        var button = add[i]
        button.addEventListener('click', addFunction)
    }
}
function forMultipleDeleteButtonEventUpdate(){
    var deleteItem = document.getElementsByClassName("delete");
    for (var i = 0; i < deleteItem.length; i++) {
        var button = deleteItem[i]
        button.addEventListener('click', deleteCartItem)
    }
}

function forMultipleMinusButtonEventUpdate(){
    var minus = document.getElementsByClassName("minus");
    for (var i = 0; i < minus.length; i++) {
        var button = minus[i]
        button.addEventListener('click', minusFunction)
    }
}

forMultipleAddButtonEventUpdate()
function addFunction(event){
    btn = event.target;
    
    test = btn.parentElement.parentElement.parentElement.parentElement;
    test.classList.add("addAnimation")
    setTimeout(function () { resetZoomOut(test); }, 500);

    counter = btn.parentElement.children[1].value;
    
    parseInt(counter)
    counter = parseInt(counter) + parseInt(1)
    btn.parentElement.children[1].value = counter
    //console.log(counter)


    // store in local storage
    let allItems = JSON.parse(localStorage.getItem("happyPaws_cartItems"));
    for (var item_in_Cart in allItems){

        if (allItems[item_in_Cart].name == btn.parentElement.parentElement.parentElement.children[0].innerText){
            allItems[item_in_Cart].count = counter
            localStorage.setItem('happyPaws_cartItems',JSON.stringify(allItems));
        }
    }
    calcTotal();
}

forMultipleMinusButtonEventUpdate()
function minusFunction(event){
    btn = event.target;
    counter = btn.parentElement.children[1].value;
    counter -= 1;

    test = btn.parentElement.parentElement.parentElement.parentElement;
    test.classList.add("minusAnimation")
    setTimeout(function () { resetZoomSmall(test); }, 500);

    if (counter > 0){
        
        btn.parentElement.children[1].value = counter

        // store in local storage
        let allItems = JSON.parse(localStorage.getItem("happyPaws_cartItems"));
        for (var item_in_Cart in allItems){

            if (allItems[item_in_Cart].name == btn.parentElement.parentElement.parentElement.children[0].innerText){
                allItems[item_in_Cart].count = counter
                localStorage.setItem('happyPaws_cartItems',JSON.stringify(allItems));
            }
        }

        calcTotal();
    }else if (counter < 1){
        //alert("Your quantity can't be 0");
        let alertBox = document.querySelector(".overlay_bg");
        let popUpAlertBox = document.querySelector(".popUpAlertBox");
        alertBox.classList.remove("default");
        popUpAlertBox.classList.add("open");
    }
    
}

forMultipleDeleteButtonEventUpdate()

function deleteCartItem(event){
    btn = event.target
    aa = btn.parentElement;
    aa.classList.add("aaa")

    let deleteItem = btn.parentElement.children[1].children[0].innerText;
    let allItems = JSON.parse(localStorage.getItem("happyPaws_cartItems"));
    setTimeout(function () { deleteItemFunction(deleteItem, allItems); }, 200);
    
}


function deleteItemFunction(deleteItem, allItems){
    for ( itemInCart in allItems ){

        if ( allItems[itemInCart].name == deleteItem ){
            allItems.splice(itemInCart, 1);
            localStorage.setItem('happyPaws_cartItems',JSON.stringify(allItems));
        }
    }
    createCart()
}


calcTotal()


function calcTotal(){
    let allItems = JSON.parse(localStorage.getItem('happyPaws_cartItems'));
    let total = 0.0;
    for ( itemInCart in allItems ){
        totalPriceOfItem = allItems[itemInCart].price * allItems[itemInCart].count;
        total += parseFloat(totalPriceOfItem);
    }
    total = total.toFixed(2);
    total = "RM " + total;
    let showTotal = document.querySelector("#showTotal");
    //console.log(showTotal)
    showTotal.innerText = total;
}

function resetZoomSmall(test){
    test.classList.remove("minusAnimation")
}
function resetZoomOut(test){
    test.classList.remove("addAnimation")
}
