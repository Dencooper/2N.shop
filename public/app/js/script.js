const exclusiveTabs = document.querySelectorAll(".exclusive-tab");
const homeCartegoryContents = document.querySelectorAll(".home-cartegory-content");
exclusiveTabs.forEach(function(tittleItem, index){
    exclusiveTabs[index].addEventListener("click", function(){
        document.querySelector(".exclusive-tab.active").classList.remove("active");
        exclusiveTabs[index].classList.add("active");
        document.querySelector(".home-cartegory-content.active").classList.remove("active");
        homeCartegoryContents[index].classList.add("active");
    })
})