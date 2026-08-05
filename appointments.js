// ==========================
// Elements
// ==========================

const addAppointmentBtn = document.querySelector(".add-btn");

const appointmentModal = document.getElementById("appointmentModal");

const closeBtn = document.querySelector(".close-btn");

const cancelBtn = document.querySelector(".cancel-btn");


// ==========================
// Open Modal
// ==========================

addAppointmentBtn.addEventListener("click", function(){

    appointmentModal.style.display = "flex";

});


// ==========================
// Close Button
// ==========================

closeBtn.addEventListener("click", function(){

    appointmentModal.style.display = "none";

});


// ==========================
// Cancel Button
// ==========================

cancelBtn.addEventListener("click", function(){

    appointmentModal.style.display = "none";

});


// ==========================
// Outside Click Close
// ==========================

window.addEventListener("click", function(event){

    if(event.target === appointmentModal){

        appointmentModal.style.display = "none";

    }

});


// ==========================
// Form Submit
// ==========================

const appointmentForm = document.getElementById("appointmentForm");

appointmentForm.addEventListener("submit", function(e){

    e.preventDefault();

    alert("Appointment added successfully!");

    appointmentModal.style.display = "none";

    appointmentForm.reset();

});