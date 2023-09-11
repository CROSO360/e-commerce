addEventListener('DOMContentLoaded', ()=>{
    actualizarCarritoUI();
});

var deunaBoton = document.getElementById("deuna");
deunaBoton.addEventListener("click", mostrardeuna);

var transferenciaBoton = document.getElementById("transferencia");
transferenciaBoton.addEventListener("click", mostrartransferencia);

var pickupBoton = document.getElementById("pickup");
pickupBoton.addEventListener("click", mostrarpickup);

var deliveryBoton = document.getElementById("delivery");
deliveryBoton.addEventListener("click", mostrardelivery);

/*let subtotal = parseFloat(document.getElementById("sub").value);
let iva = parseFloat(document.getElementById("iva").value);
let recargo = 3.0;
let total = parseFloat(document.getElementById("total").value);*/

/*const totalActual = document.getElementById("total").value;

var direccion = document.getElementById("direccion");
var total = document.getElementById("total");

var totalEnvio = parseFloat(total.value) + 3.0;

direccion.oninput = function(){
    if (this.value == 'delivery') {
        total.innerHTML = totalEnvio;
    }else{
        total.innerHTML = totalActual;
    }
};*/


function mostrardelivery() {
    document.getElementById("respuestadireccion").innerHTML = "Entrega a Domicilio";
    document.getElementById("formulario").style.display = "block";
    document.getElementById("direccion").value = "delivery";
    document.getElementById('recargo').innerHTML = "3";
}

function mostrarpickup() {
    document.getElementById("respuestadireccion").innerHTML = "Retirar en el Local";
    document.getElementById("formulario").style.display = "none";
    document.getElementById("direccion").value = "pickup";
    document.getElementById('recargo').innerHTML = "0";
}

function mostrardeuna() {
    document.getElementById("respuestapago").innerHTML = "DeUna<div></div>";
    document.getElementById("pago").value = "deuna";
}

function mostrartransferencia() {
    document.getElementById("respuestapago").innerHTML = "Transferencia";
    document.getElementById("pago").value = "transferencia";
}



/*var nombre = document.getElementById('nombre');
var apellidos = document.getElementById('apellidos');*/
var telefono = document.getElementById('telefono');
var calle = document.getElementById('calle');
var avenida = document.getElementById('avenida');
var referencia = document.getElementById('referencia');

/*var nombre2 = document.getElementById('nombre2');
var apellidos2 = document.getElementById('apellidos2');*/
var telefono2 = document.getElementById('telefono2');
var calle2 = document.getElementById('calle2');
var avenida2 = document.getElementById('avenida2');
var referencia2 = document.getElementById('referencia2');

/*nombre.addEventListener("change", function () {
    nombre2.value = nombre.value;
});

apellidos.addEventListener("change", function () {
    apellidos2.value = apellidos.value;
});*/

telefono.addEventListener("change", function () {
    telefono2.value = telefono.value;
});

calle.addEventListener("change", function () {
    calle2.value = calle.value;
});

avenida.addEventListener("change", function () {
    avenida2.value = avenida.value;
});

referencia.addEventListener("change", function () {
    referencia2.value = referencia.value;
});


/*var abrirPestanaBoton = document.getElementById("finaliza");
abrirPestanaBoton.addEventListener("click", abrirPestana);*/

function actualizarCarritoUI() {
    fetch('http://localhost:8081/croso3/api/carrito/api-carrito.php?action=mostrar')
    .then(response => {
        return response.json();
    })
    .then(data => {
        console.log(data);
        let tablaCont = document.querySelector('#tabla');
        let tablaArt = document.querySelector('#wase');
        let html = ``;
        data.items.forEach(element => {
            html += `
            
    

                <div class="product">
                    <div class="alerta">
                        <a><img src="../img/${element.imagen}"></a>
                        <div style="flex-direction:column;display: flex;justify-content: left;">
                            <a>
                                <h2>${element.nombre}</h2>
                            </a>
                            <!--p style="margin-left: 10px;">Categoría: Útiles Escolares</p-->
                            <div
                                style=" align-items: center; margin-left: 10px; flex-direction:row;display: flex;justify-content: left;">
                                Cantidad: ${element.cantidad}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a>
                        <p>$${element.subtotal}</p>
                    </a>
                </div>
            
        `;
        });

        tablaCont.innerHTML = html;

        tablaArt.innerHTML = `Finalizar compra [${data.info.count} artículos]`;

    });
}

/*function abrirPestana() {

    window.open('http://localhost:8081/croso3/shop/final.php');
}*/
