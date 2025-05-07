function toggleDropdown() {
    const dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("active");
}

window.addEventListener("click", function(event) {
    const profile = document.querySelector(".nav-profile");
    const dropdown = document.getElementById("dropdown");

    if (profile && dropdown && !profile.contains(event.target)) {
        dropdown.classList.remove("active");
    }
});
// Responsive navigation toggle based on W3Schools example
// https://www.w3schools.com/howto/howto_js_topnav.asp