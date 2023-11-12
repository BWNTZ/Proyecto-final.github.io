/* VARIABLES */
let formulario2 = document.forms["mostrar"];
let precio = formulario2["precio"];
let botonMostrar = formulario2.querySelector('[name="mostrar"]');

/* COMPROBACIONES */
precio.addEventListener("input", preciovali);
botonMostrar.addEventListener("click", mostrarVali);

/* FUNCION */
function preciovali() {
    precio.setCustomValidity('');
    precio.nextElementSibling.innerHTML="";
    if (precio.value === "") {
        precio.setCustomValidity('El rango de precios no puede estar vacío.');
        precio.reportValidity();
        return false;
    }
    return true;
}

function mostrarVali(event) {
    if (!preciovali()) {
        event.preventDefault();
    }
}
/*

//////////////////// SCRIPTS DE TRANSACCIONES PARA MOSTRAR PRECIO TOTAL EN TABLAS /////////////////////////////


<script>
				
var addPrecio = document.querySelector("input");

addPrecio.addEventListener('input', () => {

    //var camposCantidad = document.querySelectorAll("input[name^='cantidad']");
    let precio = window.prompt("Introduce el texto que desee.");

    //document.querySelector("#addText").innerHTML = precio;

});
// var tabla = document.querySelector("table");
// var div = document.createElement("div");
// div.textContent = "lalaa";
// tabla.insertAdjacentElement("afterend", div);

</script> 


/////////////////////////////////////////
////////////////////////////////////////

// Obtener el id del usuario que realiza la compra
// $usuario = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE nombre='admin'"));

// Insertar la compra en la tabla compras

// mysqli_query($conexion, "INSERT INTO compras (id_usuario, precio_total) VALUES ('".$usuario['id_usuario']."', '".$subtotal."')");
// $id_compra = mysqli_insert_id($conexion);

// Insertar los productos comprados en la tabla detalle_compra

// foreach($productos_comprados as $producto) {
// 	mysqli_query($conexion, "INSERT INTO detalle_compra (id_compra, id_producto, cantidad, precio_unitario) VALUES ('".$id_compra."', '".$producto['id_producto']."', '".$producto['cantidad']."', '".$verProducto[$producto['id_producto']-1]['precio']."')");
// }

// Mostrar mensaje de éxito
	echo "<p>Compra realizada con éxito. Subtotal: ".$subtotal."</p>";
} else {
    echo "<p>Seleccione la cantidad deseada de cada producto y presione el botón Comprar.</p>";
} else {
    echo "<p>No se pudo obtener la información de los productos.</p>";
}

<script>
// Obtener la tabla y la última fila
var tabla = document.getElementsByTagName("table")[0];
var ultimaFila = tabla.rows[tabla.rows.length - 1];

// Crear un nuevo elemento para mostrar el subtotal
var subtotalElemento = document.createElement("p");
ultimaFila.insertAdjacentElement("afterend", subtotalElemento);

// Obtener todos los campos de cantidad y calcular el subtotal
var camposCantidad = document.querySelectorAll('input[type="number"][name^="cantidad["][name$="]"]');//("input[name^='cantidad']");

for (var i = 0; i < camposCantidad.length; i++) {
var cantidad = camposCantidad[i].value;
console.log(cantidad);}

var subtotal = 0;
// var subtotal =  echo $subtotal; 
camposCantidad.forEach(function(campoCantidad) {
    var cantidad = parseInt(campoCantidad.value);
    var precio = parseFloat(campoCantidad.parentNode.previousElementSibling.textContent);
    subtotal += cantidad * precio;
});

// Mostrar el subtotal
subtotalElemento.textContent = "Subtotal: $" + subtotal.toFixed(2);
</script>

<div id='subtotal'></div>
<script>
var subtotal = <php echo $subtotal; ?>;
document.getElementById("subtotal").innerHTML = "Subtotal: " + subtotal + " €";
</script>
*/
               