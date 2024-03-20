const increase = document.querySelectorAll(".increase");
const decrease = document.querySelectorAll(".decrease");
var quanlityInput = document.querySelector("#quantity-input");
var shopItem = document.getElementsByClassName("product-content-right");
var color
var quanlity

decrease.forEach(function(decreasing, index){
    decreasing.addEventListener("click", function(){
        if (quanlityInput.value == 0) {
            quanlityInput.value = 0
        }
        else{
            quanlityInput.value--;
        }
        changeQuatity()
    })
});
increase.forEach(function(increasing, index){
    increasing.addEventListener("click", function(){
        quanlityInput.value++;
        changeQuatity()
    })
});


const buttonColors = document.querySelectorAll(".product-content-right-color li");
color = document.querySelector(".product-content-right-color li.active").textContent;
document.querySelector(".color").textContent = color;
buttonColors.forEach(function(buttonColor, index){
    buttonColor.addEventListener("click", function(){
        document.querySelector(".product-content-right-color li.active").classList.remove("active");
        buttonColor.classList.add("active");
        color = buttonColor.children[0].textContent;
        document.querySelector(".color").textContent = color;
    })
})

function changeQuatity(){
    quanlity = quanlityInput.value;
}





