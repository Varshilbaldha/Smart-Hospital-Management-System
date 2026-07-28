// ==========================
// Modal Elements
// ==========================

const addStaffBtn = document.querySelector(".add-btn");
const modal = document.getElementById("staffModal");
const closeBtn = document.querySelector(".close-btn");
const cancelBtn = document.querySelector(".cancel-btn");


// ==========================
// Open Modal
// ==========================

addStaffBtn.addEventListener("click", () => {

    modal.style.display = "flex";

});


// ==========================
// Close Modal
// ==========================

closeBtn.addEventListener("click", () => {

    modal.style.display = "none";

});


cancelBtn.addEventListener("click", () => {

    modal.style.display = "none";

});


// ==========================
// Close Modal on Outside Click
// ==========================

window.addEventListener("click", (e) => {

    if (e.target === modal) {

        modal.style.display = "none";

    }

});
// ==========================
// Form Submit
// ==========================

const staffForm = document.getElementById("staffForm");

staffForm.addEventListener("submit", function (e) {

    e.preventDefault();

    alert("Staff added successfully!");

    modal.style.display = "none";

    staffForm.reset();

});