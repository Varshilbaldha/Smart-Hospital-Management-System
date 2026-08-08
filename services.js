// ==========================
// Elements
// ==========================

const addServiceBtn = document.querySelector(".add-btn");

const serviceModal = document.getElementById("serviceModal");

const closeBtn = document.querySelector(".close-btn");

const cancelBtn = document.querySelector(".cancel-btn");

const serviceForm = document.getElementById("serviceForm");


// ==========================
// Open Modal
// ==========================

addServiceBtn.addEventListener("click", function(){

    serviceModal.style.display = "flex";

});


// ==========================
// Close Modal
// ==========================

closeBtn.addEventListener("click", function(){

    serviceModal.style.display = "none";

});


// ==========================
// Cancel Button
// ==========================

cancelBtn.addEventListener("click", function(){

    serviceModal.style.display = "none";

});


// ==========================
// Outside Click Close
// ==========================

window.addEventListener("click", function(event){

    if(event.target === serviceModal){

        serviceModal.style.display = "none";

    }

});


// ==========================
// Form Submit
// ==========================

serviceForm.addEventListener("submit", function(e){

    e.preventDefault();

    alert("Service added successfully!");

    serviceModal.style.display = "none";

    serviceForm.reset();

});
