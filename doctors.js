// =======================================
// Doctors Modal
// =======================================

const addDoctorBtn = document.querySelector(".add-btn");

const doctorModal = document.getElementById("doctorModal");

const closeDoctorModal = document.getElementById("closeDoctorModal");

const cancelBtn = document.querySelector(".cancel-btn");



// Open Modal

addDoctorBtn.addEventListener("click", () => {

    doctorModal.classList.add("show");

});



// Close Modal (X Button)

closeDoctorModal.addEventListener("click", () => {

    doctorModal.classList.remove("show");

});



// Close Modal (Cancel Button)

cancelBtn.addEventListener("click", () => {

    doctorModal.classList.remove("show");

});



// Close When Clicking Outside

window.addEventListener("click", (event) => {

    if (event.target === doctorModal) {

        doctorModal.classList.remove("show");

    }

});



// Close Using ESC Key

document.addEventListener("keydown", (event) => {

    if (event.key === "Escape") {

        doctorModal.classList.remove("show");

    }

});