// ==========================
// Elements
// ==========================

const addPatientBtn = document.querySelector(".add-btn");

const patientModal = document.getElementById("patientModal");

const closeBtn = document.querySelector(".close-btn");

const cancelBtn = document.querySelector(".cancel-btn");


// ==========================
// Open Modal
// ==========================

addPatientBtn.addEventListener("click", function(){

    patientModal.style.display = "flex";

});


// ==========================
// Close Button
// ==========================

closeBtn.addEventListener("click", function(){

    patientModal.style.display = "none";

});


// ==========================
// Cancel Button
// ==========================

cancelBtn.addEventListener("click", function(){

    patientModal.style.display = "none";

});


// ==========================
// Outside Click Close
// ==========================

window.addEventListener("click", function(event){

    if(event.target === patientModal){

        patientModal.style.display = "none";

    }

});