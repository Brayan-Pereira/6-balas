//Menu hambuger

const btnOn = document.querySelector("#btn_menu")
const menu = document.querySelector(".menu_hamburger")
const btnOff = document.querySelector("#btnOff_menu")

btnOn.addEventListener("click", () =>{
        menu.style.display = "block"
        
})

btnOff.addEventListener("click", () =>{
    menu.style.display= "none"
} )