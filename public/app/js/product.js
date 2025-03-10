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


const buttonColors = document.querySelectorAll(".list-color .button-color");
document.querySelector(".color").textContent = color;
buttonColors.forEach(function(buttonColor, index){
    buttonColor.addEventListener("click", function(){
        var count = document.querySelectorAll(".list-color .button-color.active").length;
        if(count == 1){
            document.querySelector(".list-color .button-color.active").classList.remove("active");
            buttonColor.classList.add("active");
        } else {
            buttonColor.classList.add("active");
        }
        color = buttonColor.children[0].textContent;
        document.querySelector(".color").textContent = color;
    })
})

const buttonSizes = document.querySelectorAll(".list-size .button-size");
buttonSizes.forEach(function(buttonSize, index){
    buttonSize.addEventListener("click", function(){
        var count = document.querySelectorAll(".list-size .button-size.active").length;
        if(count == 1){
            document.querySelector(".list-size .button-size.active").classList.remove("active");
            buttonSize.classList.add("active");
        } else {
            buttonSize.classList.add("active");
        }
    })
})

function changeQuatity(){
    quanlity = quanlityInput.value;
}

const galeries = document.querySelectorAll(".galery");
const bigImages = document.querySelectorAll(".bigImage");
galeries.forEach(function(galery, index){
    galeries[index].addEventListener("click", function(){
        document.querySelector(".bigImage.active").classList.remove("active");
        bigImages[index].classList.add("active");
    })
})



