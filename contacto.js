/* VARIABLES */
let formulario = document.forms["form-main"];
let nombre = formulario["nombre"];
let mail = formulario["correo"];
let tel = formulario["telefono"];
let mensaje = formulario["mensaje"];
let enviar = formulario["enviar"];

let capcha;

/* COMPROBACIONES */
nombre.addEventListener("input", nombrevali);

mail.addEventListener("input", mailvali);

tel.addEventListener("input", telefonoVali);

// mensaje.addEventListener("input", mensajeVali);

/* FUNCIONES DE LOS EVENTSLISTENERS */
function nombrevali() {
    nombre.setCustomValidity('');
    nombre.nextElementSibling.innerHTML="";
    if (nombre.reportValidity()) {
        nombre.nextElementSibling.innerHTML="Válido!";
        nombre.nextElementSibling.style.color = "green";
    } else if (nombre.validity.tooShort) {
        nombre.setCustomValidity("Mínimo 3 letras");
        nombre.nextElementSibling.innerHTML="Mínimo 3 letras";
        nombre.nextElementSibling.style.color = "red";
        return false;
    } else if (!/^[a-zA-ZáéíóúñÑÁÉÍÓÚ\s]*$/.test(nombre.value)) {
        nombre.setCustomValidity("El nombre no puede contener números ni caracteres especiales.");
        nombre.nextElementSibling.innerHTML="El nombre no puede contener números ni caracteres especiales.";
        nombre.nextElementSibling.style.color = "red";
        return false;
           
    } else {
        nombre.setCustomValidity("Formato incorrecto");
        nombre.nextElementSibling.innerHTML="Formato incorrecto";
        nombre.nextElementSibling.style.color = "red";
        return false;
    }
    return true;
}

function mailvali() {
    mail.setCustomValidity('');
    mail.nextElementSibling.innerHTML="";
    if (mail.reportValidity()) {
        mail.nextElementSibling.innerHTML="Válido!";
        mail.nextElementSibling.style.color = "green";
    } else if (mail.validity.patternMismatch) {
        mail.setCustomValidity("Introduzca un formato de correo válido");
        mail.nextElementSibling.innerHTML="Introduzca un formato de correo válido";
        mail.nextElementSibling.style.color = "red";
        return false;
    } else {
        mail.setCustomValidity("Formato de correo incorrecto");
        mail.nextElementSibling.innerHTML="Formato de correo incorrecto";
        mail.nextElementSibling.style.color = "red";
        return false;
    }
    return true;
}

function telefonoVali() {
    tel.setCustomValidity('');
    tel.nextElementSibling.innerHTML="";
    if (tel.reportValidity()) {
        tel.nextElementSibling.innerHTML="Válido!";
        tel.nextElementSibling.style.color = "green";
    } else if (tel.validity.patternMismatch) {
        tel.setCustomValidity("Introduzca un formato de teléfono válido");
        tel.nextElementSibling.innerHTML="Introduzca un formato de teléfono válido";
        tel.nextElementSibling.style.color = "red";
        return false;
    } else {
        tel.setCustomValidity("Formato de teléfono incorrecto");
        tel.nextElementSibling.innerHTML="Formato de teléfono incorrecto";
        tel.nextElementSibling.style.color = "red";
        return false;
    }
    return true;
}

/* validar el texto del mensaje no lo conseguí, se podria averiguar más.
function mensajeVali() {
    mensaje.setCustomValidity('');
    mensaje.nextElementSibling.innerHTML="";
    if (mensaje.reportValidity()) {
        mensaje.nextElementSibling.innerHTML="Válido!";
        mensaje.nextElementSibling.style.color = "green";
    } else if (mensaje.validity.tooShort) {
        mensaje.setCustomValidity("Mensaje demasiado corto");
        mensaje.nextElementSibling.innerHTML="Mensaje demasiado corto";
        mensaje.nextElementSibling.style.color = "red";
        return false;
    } else {
        mensaje.setCustomValidity("Formato incorrecto");
        mensaje.nextElementSibling.innerHTML="Formato incorrecto";
        mensaje.nextElementSibling.style.color = "red";
        return false;
    }
    return true;
}*/

// Submit form data using AJAX

formulario.addEventListener("submit", function(event) {
    event.preventDefault();

    alert("Formulario enviado con éxito");
    //enviar.insertAdjacentHTML.style.color = "green";
    
    enviar.insertAdjacentHTML('afterend', '<p>Gracias por contactarnos. Nos pondremos en contacto con usted lo antes posible.</p>');

/*  Intento fallido para cambiar el estilo del mensaje de gratitud.
    var mensajeContainer = document.getElementById('mensaje-container');
    mensajeContainer.style.fontSize = '120px';
    mensajeContainer.style.color = 'green';
    mensajeContainer.innerHTML = '<p>Gracias por contactarnos. Nos pondremos en contacto con usted lo antes posible.</p>';
    enviar.insertAdjacentElement('afterend', mensajeContainer);

    En el html hay que crear un div <div id="mensaje-container"></div>
*/
});
