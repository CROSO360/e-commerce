

addEventListener('DOMContentLoaded',()=>{
    const btn_menu=document.querySelector('.btn_menu')
    if(btn_menu){
        btn_menu.addEventListener('click',()=>{
            const menu_items=document.querySelector('.menu_items')
            menu_items.classList.toggle('show')

        });
    };

    const cookies = document.cookie.split(';');
    let cookie = null;
    actualizarCarritoUI();
    cookies.forEach(item =>{
        if(item.indexOf('items') > -1){
            cookie = item;
        }
    });
    if(cookie != null){
        const count = cookie.split('=')[1];
        console.log(count);
    }
});



function actualizarCarritoUI(){
    fetch('http://localhost:8081/croso3/api/carrito/api-carrito.php?action=mostrar')
    .then(response =>{
        return response.json();
    })
    .then(data =>{
        console.log(data);
        let tablaCont = document.querySelector('#tabla');
        let precioTotal = '';
        let html = ``;
        data.items.forEach(element => {
            html += `
                
                    <div class="carrito">
                        <img src='../img/${element.imagen}' width='140' height='110' />
                        <div class='info'>
                            <input type='hidden' value='${element.id}' />
                            <div class='nombre'>${element.nombre}</div>
                            <div >$${element.precio}</div>
                            <div>Cantidad: ${element.cantidad}</div>
                            <div>Costo: $${element.subtotal}</div>
                            <!--div class='botones'><button class='btn-remove'>Quitar 1 del carrito</button></div-->
                            <div class='botones'><button class='remove'>Quitar 1 del carrito</button></div>
                            </div>
                    </div>
                
            `;
        });

        
        precioTotal = `

            <h3>Subtotal</h3>
            <h4>$${data.info.total}</h4>
            <a href="carrito.php"><button class="vercarro">Ir al carrito</button></a></br>
        
        `;
        tablaCont.innerHTML = precioTotal + html;

        document.querySelectorAll('.remove').forEach(boton =>{
            boton.addEventListener('click', () => {
                const id = boton.parentElement.parentElement.children[0].value;
                removeItemFromCarrito(id);
            })
        });
    });
}

const botones = document.querySelectorAll('.align-items-end');

botones.forEach(boton => {
    const id = boton.parentElement.parentElement.children[0].children[0].value;

    boton.addEventListener('click', e =>{
        addItemToCarrito(id);
    });
});





const addItemToCarrito = id =>{
    fetch('http://localhost:8081/croso3/api/carrito/api-carrito.php?action=add&id=' + id)
    .then(response =>{
        return response.text();
    })
    .then(data =>{
        actualizarCarritoUI();
    });
};

const removeItemFromCarrito = id =>{
    fetch('http://localhost:8081/croso3/api/carrito/api-carrito.php?action=remove&id=' + id)
    .then(res =>{
        return res.json();
    })
    .then(data =>{
        console.log(data.statuscode);
        actualizarCarritoUI();
    });
};
//const categoria = document.getElementById("ord");

/*categoria.addEventListener("onchange",(e)=>{
    prompt("si chucha");
});*/

//var nose = categoria();
/*

function categoria(){
    var categoria = document.getElementById("ord").value;
    prompt(categoria);
};*/
 
//----------------------------------------------------------------------------------------



