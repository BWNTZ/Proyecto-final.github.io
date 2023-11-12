// Obtener todos los elementos de clase "Accordion-header"
let headers = document.querySelectorAll(".Accordion-header");

// Iterar sobre los elementos y agregar un evento de clic
headers.forEach(function(header) {
    header.addEventListener("click", function() {
        // Obtener el elemento padre (Accordion-item)
        var parent = this.parentElement;

        // Alternar la clase "active" para mostrar/ocultar el contenido
        parent.classList.toggle("active");

        var image = this.querySelector("img");
        if (parent.classList.contains("active")) {
            image.src = "images/angulo-hacia-arriba.png";
        } else {
            image.src = "images/angulo-hacia-abajo.png";
        }
    });
});