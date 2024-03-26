/* Shopping Cart Section */
if (document.readyState == 'loading'){
    document.addEventListener('DOMContentLoaded' , ready);
}

else{
    ready();
}


 function ready(){
    // remove item
    var removeCartItemButton = document.getElementsByClassName('btn-remove-item');
    for (var i = 0 ; i < removeCartItemButton.length; i++){
        var button = removeCartItemButton[i];
        button.addEventListener('click', removeCartItem)
    }
    // change quanlity item
    const increase = document.querySelectorAll(".increase");
    const decrease = document.querySelectorAll(".decrease");
    var quanlityInputs = document.querySelectorAll(".cart-quantity-input");

    decrease.forEach(function(decreasing, index){
        decreasing.addEventListener("click", function(event){
            quanlityInputs[index].value--;
            if(isNaN(quanlityInputs[index]) || quanlityInputs[index] <= 0 ){
                removeCartItem(event)
            }
        })
    });

    increase.forEach(function(increasing, index){
        increasing.addEventListener("click", function(){
            quanlityInputs[index].value++;
        })
    });

    // document.getElementsByClassName('btn-purchase')[0].addEventListener('click', purchaseClicked)


//  function purchaseClicked(){
//      alert('Thank you for your purchase!!!');
//      var cartItems = document.getElementsByClassName('cart-items')[0];
//      while(cartItems.hasChildNodes()){
//          cartItems.removeChild(cartItems.firstChild)
//      }
//      updateCartTotal();
//  }

function removeCartItem(event){
    var buttonClicked = event.target;
    buttonClicked.parentElement.parentElement.parentElement.remove();
    // updateCartTotal();
}


function addItemToCart(title, price, imageSrc){
    var cartRow = document.createElement('tr');
    cartRow.classList.add('cart-row');
    var cartItems = document.getElementsByClassName('cart-items')[0];
    var cartItemNames = cartItems.getElementsByClassName('cart-item-title');

    for (i = 0; i< cartItemNames.length ; i++){
        if(cartItemNames[i].innerText == title){
            alert('This item already has added to the cart!');
            return
        }
    }
    var cartRowContents = `

        <td class="cart-item cart-column">
            <img class="cart-item-image" src="${imageSrc}" width="50" height="50">
            <span class="cart-item-title">${title}</span>                  
        </td>
        <td class="cart-item cart-column">
            <span class="cart-price cart-column">${price}</span>
        </td>
        <td class="cart-item cart-column">
            <input class="cart-quantity-input" type="number" value="1" style="width: 50px">
            <button class="btn btn-danger" type="button">Remove</button>
        </td>        
    `;
     
            
    cartRow.innerHTML = cartRowContents;
    cartItems.append(cartRow);
}


// function updateCartTotal(){
//     var cartItemContainer = document.getElementsByClassName('cart-items')[0];
//     var cartRows = cartItemContainer.getElementsByClassName('cart-row');
//     var total = 0;
//     for (var i = 0 ; i< cartRows.length ; i++){
//         var cartRow =cartRows[i];
//         var priceElement = cartRow.getElementsByClassName('cart-price')[0];
//         var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0];
//         var price = parseFloat(priceElement.innerText.replace('Rs ' , ''))
//         var quantity = quantityElement.value;
//         total = total + (price * quantity);
         
//     }
//     total = Math.round(total * 100 )/100;
//     document.getElementsByClassName('cart-total-price')[0].innerText = 'Rs '+ total + '.00';
 
}