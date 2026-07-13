// ============================
// ELEMENTS
// ============================

const addButton =
document.querySelector(".add-btn");

const modal =
document.getElementById("departmentModal");

const closeButton =
document.getElementById("closeModal");

const cancelButton =
document.querySelector(".cancel-btn");



// ============================
// OPEN MODAL
// ============================

addButton.addEventListener("click", function(){

    modal.style.display = "flex";

});



// ============================
// CLOSE MODAL
// ============================

closeButton.addEventListener("click", function(){

    modal.style.display = "none";

});



cancelButton.addEventListener("click", function(){

    modal.style.display = "none";

});



// ============================
// OUTSIDE CLICK
// ============================

window.addEventListener("click", function(e){

    if(e.target === modal){

        modal.style.display = "none";

    }

});



// ============================
// ESC KEY
// ============================

document.addEventListener("keydown", function(e){

    if(e.key === "Escape"){

        modal.style.display = "none";

    }

});