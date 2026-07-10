
const sidebar = document.querySelector(".sidebar");

const sidebarToggle =
    document.getElementById("sidebarToggle");


sidebarToggle.addEventListener("click", function()
{

    sidebar.classList.toggle("closed");

});