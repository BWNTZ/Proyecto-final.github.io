let formulario = document.forms["formularioVendedor"];
let mensaje = formulario["mensajeVendedor"];
let enviar = formulario["enviar"];

formulario.addEventListener("submit", function(event) {
    event.preventDefault(); 
    alert("Formulario enviado con éxito");
    enviar.insertAdjacentHTML('afterend', '<p>Gracias por contactarnos. Revisaremos su petición lo antes posible.</p>');
});