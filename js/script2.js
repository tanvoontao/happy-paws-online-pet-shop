function slideFunction(){
    let startingPage = document.querySelector(".startingPage");
    startingPage.classList.add("active");
    let categoryAnimation = document.getElementsByClassName("category_box");
    for (let i = 0; i < categoryAnimation.length; i++) {
        categoryAnimation[i].classList.add("categoryBoxAnimation");
        
    }
}

function updateCartCounter(){
    var counter = 0;
    let happyPaws_cartItems = JSON.parse(localStorage.getItem("happyPaws_cartItems"));
    const cartCounter = document.querySelector('ul');

    for ( var itemInside in happyPaws_cartItems ){
        counter += happyPaws_cartItems[itemInside].count;
    }

    cartCounter.innerHTML = `
    <li>${counter}</li>
    `;

}

function goBack() {
    window.history.back();
}

function createCart(){
    const productCardInCart = document.querySelector(".cart_form");
    let cartData = '';

    JSON.parse(localStorage.getItem('happyPaws_cartItems')).map(data=>{
        cartData += `
        <li class="shopping_cart_product_card">
            <img src="${data.img}" alt="testing"/>
            <div>
                <p>${data.name}</p>
                <div>
                    <p>RM ${data.price}</p>
                    <div>
                        <button class="minus">&#8722;</button>
                        <input type='number' min="0" value="${data.count}">
                        <button class="add">&#43;</button>
                    </div>
                </div>
                
            </div>
            <button class="delete">🗑️</button>
        </li>
        `;
    });
    productCardInCart.innerHTML = cartData;
    
 
    forMultipleDeleteButtonEventUpdate();
    forMultipleMinusButtonEventUpdate();
    forMultipleAddButtonEventUpdate();
    calcTotal()
    
}

function sendToWhatsApp(){
    var pickUpTime = document.getElementById("pickUpTime").value;
    console.log(pickUpTime);
    let total = 0.0;
    let message = `Thank you for your order!%0aClick send to send order%0aPick up time: ${pickUpTime}%0a------------------------%0a`;

    allItems = JSON.parse(localStorage.getItem('happyPaws_cartItems'));
    for ( sendIem in allItems ){
        itemPrice = allItems[sendIem].price * allItems[sendIem].count;
        total += parseFloat(itemPrice);

        message += allItems[sendIem].name + " x"+allItems[sendIem].count + "%0a";
    }
    total = total.toFixed(2);
    message += "------------------------%0aTotal: RM " + total;
    localStorage.removeItem("happyPaws_cartItems");
    console.log(message);
    location.href = "https://wa.me/601139280595?text=" + message
}