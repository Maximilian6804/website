document.querySelectorAll('nav ul li a').forEach(anchor => {
    anchor.addEventListener('click', function(event) {
        console.log(`Clicked link: ${this.getAttribute('href')}`); // Debugging
        const href = this.getAttribute('href');

        // Überprüfe, ob es sich um einen internen Link handelt
        if (href.startsWith('#')) {
            event.preventDefault(); // Verhindert das Standardverhalten
            const section = document.querySelector(href);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }
    });
});


function toggleDropdown() {
    var dropdownMenu = document.getElementById("dropdown-menu");
    // Toggle die Sichtbarkeit des Dropdown-Menüs
    if (dropdownMenu.style.display === "block") {
        dropdownMenu.style.display = "none";
    } else {
        dropdownMenu.style.display = "block";
    }
}

// Schließt das Dropdown-Menü, wenn außerhalb geklickt wird
window.onclick = function(event) {
    if (!event.target.matches('.user-button')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            dropdowns[i].style.display = "none";
        }
    }
}
