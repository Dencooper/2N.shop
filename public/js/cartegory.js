const sliderbar = document.querySelectorAll(".cartegory-left-li-menu");
sliderbar.forEach(function(menu, index){
    menu.addEventListener("click", function(){
        menu.classList.toggle("block")
    })
});

function formatNumberWithCommas(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

const amountFrom = document.querySelector("#amount-from");
const valueRange = document.querySelector("#myRange");
valueRange.addEventListener("input", (event) => {
    amountFrom.textContent = formatNumberWithCommas(event.target.value) + "đ";
});

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

const buttonColors = document.querySelectorAll(".list-color .button-color");
buttonColors.forEach(function(buttonColor, index){
    buttonColor.addEventListener("click", function(){
        var count = document.querySelectorAll(".list-color .button-color.active").length;
        if(count == 1){
            document.querySelector(".list-color .button-color.active").classList.remove("active");
            buttonColor.classList.add("active");
        } else {
            buttonColor.classList.add("active");
        }
    })
})