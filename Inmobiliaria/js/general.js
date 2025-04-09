document.addEventListener("DOMContentLoaded", function () {
    const dropdowns = document.querySelectorAll(".nav-item");

    dropdowns.forEach((dropdown) => {
        const link = dropdown.querySelector("a");
        const submenu = dropdown.querySelector(".submenu");

        if (submenu) {
            link.addEventListener("click", function (event) {
                event.preventDefault(); // Evita que el enlace se redirija
                submenu.style.display = submenu.style.display === "block" ? "none" : "block";
            });

            // Cierra el submenú si se hace clic fuera de él
            document.addEventListener("click", function (event) {
                if (!dropdown.contains(event.target)) {
                    submenu.style.display = "none";
                }
            });
        }
    });

    

    
});
