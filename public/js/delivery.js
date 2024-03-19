const check = document.querySelector("#checkbox");
const subVAT = document.querySelector(".checked-vat")
check.addEventListener("click",function(){
    if (subVAT.style.display == "none") {
        subVAT.style.display = "block";
    } else {
        subVAT.style.display = "none";
    }
})